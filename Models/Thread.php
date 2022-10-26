<?php

declare(strict_types=1);

namespace Modules\Forum\Models;

use App\Exceptions\CouldNotMarkReplyAsSolution;
// use Spatie\Feed\Feedable;
// use Spatie\Feed\FeedItem;
// use Illuminate\Support\Str;
// use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\DB;

// use Modules\Forum\Models\Traits\HasSlug;

use Exception;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder; // spatie tags
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Str;
use Modules\Forum\Contracts\ReplyAble;
use Modules\Forum\Contracts\SubscriptionAble;
// use Modules\Tag\Models\Traits\HasTagTrait;
use Modules\Rating\Models\Traits\HasLikes;
use Spatie\Tags\HasTags;

/*  Feedable */

// Class Modules\Forum\Models\Thread contains 1 abstract method and must
// therefore be declared abstract or implement the remaining methods (Modules\Forum\Contracts\ReplyAble::subject)
final class Thread extends BaseModel { /* implements ReplyAble, SubscriptionAble */
    use HasFactory;
    use HasLikes;
    use HasTags;
    use Traits\HasAuthor;
    use Traits\HasSlug;
    use Traits\HasTimestamps;
    use Traits\PreparesSearch;
    use Traits\ProvidesSubscriptions;
    use Traits\ReceivesReplies;
    // use Traits\Searchable;

    // public const TABLE = 'threads';

    // public const FEED_PAGE_SIZE = 20;

    /*
     * {@inheritdoc}
     protected $table = self::TABLE;
     */

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'body',
        'slug',
        'subject',
        'author_id',
    ];

    /**
     * {@inheritdoc}
     */
    protected $with = [
        'authorRelation',
        'likesRelation',
        'repliesRelation',
        'tagsRelation',
    ];

    /* Undefined property: Modules\Forum\Models\Thread::$id
    public function id(): int {
        return $this->id;
    }
    */
    // *
    public function subject(): string {
        return $this->subject;
    }

    // */
    // *
    public function body(): string {
        return $this->body;
    }

    // */

    public function excerpt(int $limit = 100): string {
        return Str::limit(strip_tags(md_to_html($this->body())), $limit);
    }

    public function solutionReply(): ?Reply {
        return $this->solutionReplyRelation;
    }

    public function solutionReplyRelation(): BelongsTo {
        return $this->belongsTo(Reply::class, 'solution_reply_id');
    }

    public function isSolved(): bool {
        return null !== $this->solution_reply_id;
    }

    public function isSolutionReply(Reply $reply): bool {
        if ($solution = $this->solutionReply()) {
            return $solution->is($reply);
        }

        return false;
    }

    public function markSolution(Reply $reply, User $user) {
        $thread = $reply->replyAble();

        if (! $thread instanceof self) {
            throw CouldNotMarkReplyAsSolution::replyAbleIsNotAThread($reply);
        }

        $this->resolvedByRelation()->associate($user);
        $this->solutionReplyRelation()->associate($reply);
        $this->save();
    }

    public function unmarkSolution() {
        $this->resolvedByRelation()->dissociate();
        $this->solutionReplyRelation()->dissociate();
        $this->save();
    }

    public function resolvedBy(): ?User {
        return $this->resolvedByRelation;
    }

    public function resolvedByRelation(): BelongsTo {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    public function wasResolvedBy(User $user): bool {
        if ($resolvedBy = $this->resolvedBy()) {
            return $resolvedBy->is($user);
        }

        return false;
    }

    public function delete() {
        $this->removeTags();
        $this->deleteReplies();

        parent::delete();
    }

    public function toFeedItem(): FeedItem {
        $updatedAt = Carbon::parse($this->latest_creation);

        return FeedItem::create()
            ->id($this->id)
            ->title($this->subject)
            ->summary($this->body)
            ->updated($updatedAt)
            ->link(route('thread', $this->slug))
            ->author($this->author()->name);
    }

    /**
     * @return \Modules\Forum\Models\Thread[]
     */
    public static function feed(int $limit = 20): Collection {
        return static::feedQuery()->limit($limit)->get();
    }

    /**
     * @return \Modules\Forum\Models\Thread[]
     */
    public static function feedPaginated(int $perPage = 20): Paginator {
        return static::feedQuery()->paginate($perPage);
    }

    /**
     * @return \Modules\Forum\Models\Thread[]
     */
    public static function feedByTagPaginated(Tag $tag, int $perPage = 20): Paginator {
        return static::feedByTagQuery($tag)
            ->paginate($perPage);
    }

    public static function feedByTagQuery(Tag $tag): Builder {
        // $pivot_table = 'taggables';
        $pivot_table = 'tag_morph';

        return static::feedQuery()
            ->join($pivot_table, function ($join) {
                $join->on('threads.id', $pivot_table.'.taggable_id')
                    ->where('taggable_type', static::TABLE);
            })
            ->where($pivot_table.'.tag_id', $tag->id());
    }

    /**
     * This will order the threads by creation date and latest reply.
     */
    public static function feedQuery(): Builder {
        return static::with([
            'solutionReplyRelation',
            'likesRelation',
            'repliesRelation',
            'repliesRelation.authorRelation',
            'tagsRelation',
            'authorRelation',
        ])
            ->leftJoin('replies', function ($join) {
                $join->on('threads.id', 'replies.replyable_id')
                    ->where('replies.replyable_type', static::TABLE);
            })
            ->orderBy('latest_creation', 'DESC')
            ->groupBy('threads.id')
            ->select('threads.*', DB::raw('
                CASE WHEN COALESCE(MAX(replies.created_at), 0) > threads.created_at
                THEN COALESCE(MAX(replies.created_at), 0)
                ELSE threads.created_at
                END AS latest_creation
            '));
    }

    /**
     * This will calculate the average resolution time in days of all threads marked as resolved.
     */
    public static function resolutionTime() {
        try {
            return static::join('replies', 'threads.solution_reply_id', '=', 'replies.id')
                ->select(DB::raw('avg(datediff(replies.created_at, threads.created_at)) as duration'))
                ->first()
                ->duration;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getFeedItems(): SupportCollection {
        return static::feedQuery()
            ->paginate(static::FEED_PAGE_SIZE)
            ->getCollection();
    }

    public function replyAbleSubject(): string {
        return $this->subject();
    }

    public function toSearchableArray(): array {
        return [
            'id' => $this->id(),
            'subject' => $this->subject(),
            'body' => $this->body(),
            'slug' => $this->slug(),
        ];
    }

    public function splitBody($value) {
        return $this->split($value);
    }

    public function scopeResolved(Builder $query): Builder {
        return $query->whereNotNull('solution_reply_id');
    }

    public function scopeUnresolved(Builder $query): Builder {
        return $query->whereNull('solution_reply_id');
    }

    public function scopeActive(Builder $query): Builder {
        return $query->has('repliesRelation');
    }
}
