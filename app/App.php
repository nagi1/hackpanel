<?php

namespace App;

use Appstract\Meta\Metable;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class App.
 * @version September 30, 2019, 2:58 pm UTC
 *
 * @property string name
 * @property string description
 * @property string version
 * @property string hash
 * @property string status
 * @property string update_url
 */
class App extends Model
{
    use SoftDeletes;
    use Metable;

    public $table = 'apps';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'description',
        'version',
        'hash',
        'status',
        'update_url',
        'access_token',
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
        'version' => 'string',
        'hash' => 'string',
        'status' => 'string',
        'update_url' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    public function keys()
    {
        return $this->hasMany(Key::class);
    }
}
