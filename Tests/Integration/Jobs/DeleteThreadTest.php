<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Models\Reply;
use Modules\Forum\Models\Thread;
use Modules\Rating\Models\Like;
use Tests\TestCase;

uses(TestCase::class);
uses(DatabaseMigrations::class);

test('we can delete a thread and its replies', function () {
    $thread = Thread::factory()->create();
    $reply = Reply::factory()->create(['replyable_id' => $thread->id()]);
    Like::factory()->thread()->create(['likeable_id' => $thread->id()]);
    Like::factory()->reply()->create(['likeable_id' => $reply->id()]);

    // $this->dispatch(new DeleteThread($thread));

    $this->assertDatabaseMissing('threads', ['id' => $thread->id()]);
    $this->assertDatabaseMissing('replies', ['replyable_id' => $thread->id()]);
    $this->assertDatabaseMissing('likes', ['likeable_type' => 'threads', 'likeable_id' => $thread->id()]);
    $this->assertDatabaseMissing('likes', ['likeable_type' => 'replies', 'likeable_id' => $reply->id()]);
});
