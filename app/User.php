<?php

namespace Screeenly;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
    //protected $fillable = ['name', 'email', 'password'];
    protected $fillable = ['email', 'token', 'api_key', 'plan', 'provider', 'provider_id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Return User associated with APIKey.
     *
     * @param string $key
     *
     * @return Screeenly\User
     */
    public static function getUserByKey($key)
    {
        $user = self::where('api_key', '=', $key)->first();

        return $user;
    }

    public function logs()
    {
        return $this->hasMany('Screeenly\APILog', 'user_id');
    }
}
