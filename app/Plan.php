<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Plan.
 * @version September 30, 2019, 9:51 pm UTC
 *
 * @property string name
 * @property string description
 * @property string hour_interval
 * @property string cost
 */
class Plan extends Model
{
    use SoftDeletes;

    public $table = 'plans';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'description',
        'interval_unit',
        'interval_value',
        'cost',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'interval_unit'=>'string',
        'interval_value' => 'integer',
        'cost' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'interval_unit' => 'required',
        'interval_value' => 'required|numeric',
        'cost' => 'sometimes|numeric',
    ];
}
