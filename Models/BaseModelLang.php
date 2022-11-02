<?php

declare(strict_types=1);

namespace Modules\Forum\Models;

////use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//---------- traits
use Illuminate\Database\Eloquent\Model;
use Modules\Lang\Models\Traits\LinkedTrait;
use Modules\Xot\Traits\Updater;

abstract class BaseModelLang extends Model {
    use Updater;
    //use Searchable;
    use LinkedTrait;
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
}
