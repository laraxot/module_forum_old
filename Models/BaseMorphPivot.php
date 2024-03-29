<?php

declare(strict_types=1);

namespace Modules\Forum\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;
use Modules\Xot\Traits\Updater;

abstract class BaseMorphPivot extends MorphPivot {
    use Updater;
    protected $appends = [];
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    // protected $attributes = ['related_type' => 'cuisine_cat'];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        // 'published_at',
    ];
    protected $fillable = [
        'id',
        'post_id', 'post_type',
        'related_type',
        'user_id',
        'note',
    ];
}
