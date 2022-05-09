<?php

declare(strict_types=1);

namespace Modules\Forum\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\LU\Models\User;

trait HasAuthor {
    public function author(): User {
        //return $this->authorRelation;
        return User::first();
    }

    public function authoredBy(User $author) {
        $this->authorRelation()->associate($author);

        $this->unsetRelation('authorRelation');
    }

    public function authorRelation(): BelongsTo {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function isAuthoredBy(User $user): bool {
        return $this->author()->is($user);
    }
}
