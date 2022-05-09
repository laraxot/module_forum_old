<?php

declare(strict_types=1);

namespace Modules\Forum\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * This interface allows models to receive replies.
 */
interface ReplyAble {
    public function subject(): string;

    /**
     * @return \Modules\Forum\Models\Reply[]
     */
    public function replies();

    /**
     * @return \Modules\Forum\Models\Reply[]
     */
    public function latestReplies(int $amount = 5);

    public function deleteReplies();

    public function repliesRelation(): MorphMany;

    public function isConversationOld(): bool;

    public function replyAbleSubject(): string;
}
