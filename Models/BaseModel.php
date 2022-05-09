<?php

declare(strict_types=1);

namespace Modules\Forum\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
////use Laravel\Scout\Searchable;
//---------- traits
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Traits\Updater;

abstract class BaseModel extends Model {
    use Updater;
    //use Searchable;
    use HasFactory;

    protected $fillable = ['id'];

    protected $casts = [
        //'published_at' => 'datetime:Y-m-d', // da verificare
    ];

    protected $dates = ['published_at', 'created_at', 'updated_at'];

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $hidden = [
        //'password'
    ];

    public $timestamps = true;

    protected $appends = [];

    /////////////
}
