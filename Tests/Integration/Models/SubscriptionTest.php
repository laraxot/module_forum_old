<?php

declare(strict_types=1);

use App\Models\Subscription;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

uses(TestCase::class);
uses(DatabaseMigrations::class);

it('can get a subscription by its uuid', function () {
    $uuid = Subscription::factory()->create()->uuid();

    $subscription = Subscription::findByUuidOrFail($uuid);

    expect($subscription->uuid())->toEqual($uuid);
});
