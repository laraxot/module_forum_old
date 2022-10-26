<?php

declare(strict_types=1);

use App\Models\User;

it('can determine if it has a password set', function () {
    $user = new User(['password' => 'foo']);

    expect($user->hasPassword())->toBeTrue();
});
