<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Undocumented class.
 */
class CreateThreadsTable extends XotBaseMigration {
    /**
     * Undocumented function.
     *
     * @return void
     */
    public function up() {
        //-- CREATE --
        if (! $this->tableExists()) {
            $this->getConn()->create(
            $this->getTable(),
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('author_id');
                $table->string('subject');
                $table->text('body');
                $table->string('slug');
                $table->string('category_slug');
                $table->integer('laravel_version');
                $table->integer('most_recent_reply_id');
                $table->integer('reply_count');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        }
        //-- UPDATE --
        $this->getConn()->table(
        $this->getTable(),
        function (Blueprint $table) {
            if (! $this->hasColumn('solution_reply_id')) {
                $table->integer('solution_reply_id')->nullable()->default(null);
            }

            if (! $this->hasColumn('created_by')) {
                $table->string('created_by')->nullable();
            }

            if (! $this->hasColumn('updated_by')) {
                $table->string('updated_by')->nullable();
            }
        }
    );
    }
}
