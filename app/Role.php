<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Role.
 * @version September 30, 2019, 10:03 pm UTC
 *
 * @property string name
 */
class Role extends Model
{
    use SoftDeletes;

    public $table = 'roles';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];
}
