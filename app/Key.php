<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent as Model;
use Appstract\Meta\Metable;

/**
 * Class Key.
 * @version September 30, 2019, 3:27 pm UTC
 *
 * @property int app_id
 * @property int user_id
 * @property int plan_id
 * @property string key
 * @property string expires
 * @property string hwid
 * @property string email
 * @property string last_use
 */
class Key extends Model
{
    use SoftDeletes;
    use Metable;

    public $table = 'keys';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'app_id',
        'user_id',
        'plan_id',
        'key',
        'expires',
        'hwid',
        'email',
        'last_use',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'app_id' => 'integer',
        'user_id' => 'integer',
        'plan_id' => 'integer',
        'key' => 'string',
        'hwid' => 'string',
        'email' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'app_id' => 'required',
        'plan_id' => 'required',

    ];

    public function customMV($array = [])
    {
        $this->visible = $array;

        return $this;
    }

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
