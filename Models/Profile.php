<?php

declare(strict_types=1);

namespace Modules\Forum\Models;

//----- traits ----
//------services---------

//--- models ---

//--- bases ---
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile as BlogProfile;
use Modules\LU\Models\User;

/**
 * Modules\Forum\Models\Profile.
 *
 * @property int                                                                      $id
 * @property int|null                                                                 $status
 * @property string|null                                                              $bio
 * @property \Illuminate\Support\Carbon|null                                          $created_at
 * @property \Illuminate\Support\Carbon|null                                          $updated_at
 * @property string|null                                                              $created_by
 * @property string|null                                                              $updated_by
 * @property string|null                                                              $deleted_by
 * @property string|null                                                              $firstname
 * @property string|null                                                              $surname
 * @property mixed                                                                    $email
 * @property string|null                                                              $phone
 * @property false|mixed|string                                                       $address
 * @property int|null                                                                 $user_id
 * @property string|null                                                              $locality
 * @property string|null                                                              $locality_short
 * @property string|null                                                              $administrative_area_level_3
 * @property string|null                                                              $administrative_area_level_3_short
 * @property string|null                                                              $administrative_area_level_2
 * @property string|null                                                              $administrative_area_level_2_short
 * @property string|null                                                              $administrative_area_level_1
 * @property string|null                                                              $administrative_area_level_1_short
 * @property string|null                                                              $country
 * @property string|null                                                              $country_short
 * @property string|null                                                              $street_number
 * @property string|null                                                              $street_number_short
 * @property string|null                                                              $route
 * @property string|null                                                              $route_short
 * @property string|null                                                              $postal_code
 * @property string|null                                                              $postal_code_short
 * @property string|null                                                              $premise
 * @property string|null                                                              $premise_short
 * @property string|null                                                              $googleplace_url
 * @property string|null                                                              $googleplace_url_short
 * @property string|null                                                              $point_of_interest
 * @property string|null                                                              $point_of_interest_short
 * @property string|null                                                              $political
 * @property string|null                                                              $political_short
 * @property string|null                                                              $campground
 * @property string|null                                                              $campground_short
 * @property string|null                                                              $postal_town
 * @property string|null                                                              $postal_town_short
 * @property string|null                                                              $post_type
 * @property string|null                                                              $website
 * @property string|null                                                              $formatted_address
 * @property string|null                                                              $min_order
 * @property string|null                                                              $delivery_cost
 * @property string|null                                                              $delivery_options
 * @property int|null                                                                 $order_action
 * @property string|null                                                              $price_currency
 * @property string|null                                                              $price_range
 * @property string|null                                                              $latitude
 * @property string|null                                                              $longitude
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Blog\Models\Article[]  $articles
 * @property int|null                                                                 $articles_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Widget[]    $containerWidgets
 * @property int|null                                                                 $container_widgets_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Blog\Models\Favorite[] $favorites
 * @property int|null                                                                 $favorites_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Forum\Models\Forum[]   $forums
 * @property int|null                                                                 $forums_count
 * @property mixed                                                                    $first_name
 * @property string                                                                   $full_address
 * @property string                                                                   $full_name
 * @property string|null                                                              $guid
 * @property string|null                                                              $image_src
 * @property string|null                                                              $lang
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Blog\Models\Privacy[]  $privacies
 * @property string|null                                                              $subtitle
 * @property string|null                                                              $title
 * @property string|null                                                              $txt
 * @property string|null                                                              $user_handle
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Blog\Models\Image[]    $images
 * @property int|null                                                                 $images_count
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Blog\Models\Favorite[] $myFavorites
 * @property int|null                                                                 $my_favorites_count
 * @property \Modules\Lang\Models\Post|null                                           $post
 * @property int|null                                                                 $privacies_count
 * @property \Modules\Food\Models\Profile|null                                        $profile
 * @property mixed                                                                    $url
 * @property \Modules\LU\Models\User|null                                             $user
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Widget[]    $widgets
 * @property int|null                                                                 $widgets_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang ofItem(string $guid)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile ofLayoutPosition($layout_position)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel1Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel2Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel3Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAuthUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCampground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCampgroundShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCountryShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeliveryCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeliveryOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFormattedAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereGoogleplaceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereGoogleplaceUrlShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLocality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLocalityShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMinOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOrderAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePointOfInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePointOfInterestShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePolitical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePoliticalShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostalCodeShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostalTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostalTownShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePremise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePremiseShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePriceCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePriceRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereRouteShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStreetNumberShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile withDistance(float $lat, float $lng)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang withPost(string $guid)
 * @mixin \Eloquent
 *
 * @property string|null $deleted_ip
 * @property string|null $created_ip
 * @property string|null $updated_ip
 * @property string|null $deleted_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedIp($value)
 */
class Profile extends BlogProfile {
    //--- relationship ---
    public function forums(): HasMany {
        return $this->hasMany(Forum::class, 'user_id', 'user_id');
    }

    public function username(): string {
        $user = $this->user;
        if (null == $user) {
            $user1 = User::firstOrCreate(['user_id' => $this->user_id]);
            dddx($user1->username());
        }

        return $user->handle;
    }

    public function name(): ?string {
        $user = $this->user;

        return $user->first_name;
    }

    public function bio(): ?string {
        $user = $this->user;

        return $user->txt;
    }

    public function isLoggedInUser(): bool {
        return $this->user_id === Auth::id();
    }

    public function id(): int {
        return $this->id;
    }

    public function emailAddress(): string {
        return $this->email;
    }

    public function githubUsername(): string {
        return $this->github_username ?? '';
    }

    public function twitter(): ?string {
        //Undefined property: Modules\Forum\Models\Profile::$twitter
        //return $this->twitter;
        return '';
    }

    public function hasTwitterAccount(): bool {
        return ! empty($this->twitter());
    }

    public function isBanned(): bool {
        return ! is_null($this->banned_at);
    }

    public function type(): int {
        return (int) $this->type;
    }

    public function isModerator(): bool {
        return self::MODERATOR === $this->type();
    }

    public function isAdmin(): bool {
        return self::ADMIN === $this->type();
    }

    public function hasPassword(): bool {
        $password = $this->getAuthPassword();

        return '' !== $password && null !== $password;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function threads() {
        return $this->threadsRelation;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latestThreads(int $amount = 5) {
        return $this->threadsRelation()->latest()->limit($amount)->get();
    }

    public function deleteThreads() {
        // We need to explicitly iterate over the threads and delete them
        // separately because all related models need to be deleted.
        foreach ($this->threads() as $thread) {
            $thread->delete();
        }
    }

    public function threadsRelation(): HasMany {
        return $this->hasMany(Thread::class, 'author_id');
    }

    public function countThreads(): int {
        return $this->threadsRelation()->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function replies() {
        return $this->replyAble;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latestReplies(int $amount = 10) {
        return $this->replyAble()->latest()->limit($amount)->get();
    }

    public function deleteReplies() {
        // We need to explicitly iterate over the replies and delete them
        // separately because all related models need to be deleted.
        foreach ($this->replyAble()->get() as $reply) {
            $reply->delete();
        }
    }

    public function countReplies(): int {
        return $this->replyAble()->count();
    }

    public function replyAble(): HasMany {
        return $this->hasMany(Reply::class, 'author_id');
    }

    public function articles(): HasMany {
        return $this->hasMany(Article::class, 'author_id');
    }

    public function latestArticles(int $amount = 10) {
        return $this->articles()->latest()->limit($amount)->get();
    }

    public function countArticles(): int {
        return $this->articles()->count();
    }

    public static function findByUsername(string $username): self {
        return static::where('username', $username)->firstOrFail();
    }

    public static function findByEmailAddress(string $emailAddress): self {
        return static::where('email', $emailAddress)->firstOrFail();
    }

    public static function findByGithubId(string $githubId): self {
        return static::where('github_id', $githubId)->firstOrFail();
    }

    public function delete() {
        $this->deleteThreads();
        $this->deleteReplies();

        parent::delete();
    }

    public function countSolutions(): int {
        return $this->replyAble()->isSolution()->count();
    }

    public function scopeMostSolutions(Builder $query, int $inLastDays = null) {
        return $query->withCount(['replyAble as solutions_count' => function ($query) use ($inLastDays) {
            $query->where('replyable_type', 'threads')
                ->join('threads', 'threads.solution_reply_id', '=', 'replies.id');

            if ($inLastDays) {
                $query->where('replies.created_at', '>', now()->subDays($inLastDays));
            }

            return $query;
        }])->orderBy('solutions_count', 'desc');
    }

    public function scopeMostSolutionsInLastDays(Builder $query, int $days) {
        return $query->mostSolutions($days);
    }

    public function scopeWithCounts(Builder $query) {
        return $query->withCount([
            'threadsRelation as threads_count',
            'replyAble as replies_count',
            'replyAble as solutions_count' => function (Builder $query) {
                return $query->join('threads', 'threads.solution_reply_id', '=', 'replies.id')
                    ->where('replyable_type', 'threads');
            },
        ]);
    }

    public function scopeHasActivity(Builder $query) {
        return $query->where(function ($query) {
            $query->has('threadsRelation')
                ->orHas('replyAble');
        });
    }

    public function scopeModerators(Builder $query) {
        return $query->whereIn('type', [
            self::ADMIN,
            self::MODERATOR,
        ]);
    }
}
