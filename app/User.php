<?php

namespace Screeenly;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Screeenly\ApiKey;
use Screeenly\ApiLog;

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
    protected $fillable = ['email', 'token', 'plan', 'provider', 'provider_id'];

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
        // Search for key in ApiKey Model
        $apiKey = ApiKey::whereKey($key)->first();

        if ($apiKey) {
            return $apiKey->user;
        }
    }

    public function logs()
    {
        return $this->hasMany(ApiLog::class, 'user_id');
    }

    /**
     * Relationship with theApikey model.
     *
     * @return    Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apikeys()
    {
        return $this->hasMany(ApiKey::class);
    }
}
