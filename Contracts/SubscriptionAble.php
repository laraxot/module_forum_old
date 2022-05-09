<?php

declare(strict_types=1);

namespace Modules\Forum\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\LU\Models\User;

interface SubscriptionAble {
    /**
     * @return \Modules\Forum\Models\Subscription[]
     */
    public function subscriptions();

    public function subscriptionsRelation(): MorphMany;

    public function hasSubscriber(User $user): bool;
}
