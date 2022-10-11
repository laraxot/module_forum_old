<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

class CreateRepliesTable extends XotBaseMigration {
    public function up() {
        //-- CREATE --
        if (! $this->tableExists()) {
            $this->getConn()->create(
            $this->getTable(),
            function (Blueprint $table) {
                $table->increments('id');
                $table->text('body');
                $table->integer('author_id');
                $table->integer('thread_id');
                $table->timestamps();
                $table->softDeletes();
            });
        }
        //-- UPDATE --
        $this->getConn()->table(
            $this->getTable(),
            function (Blueprint $table) {
                if (! $this->hasColumn('replyable_id')) {
                    $table->nullableMorphs('replyable');
                }
            }
        );
    }
}
