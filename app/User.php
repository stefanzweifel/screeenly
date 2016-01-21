<?php

namespace Screeenly;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['email', 'token', 'plan', 'provider', 'provider_id'];

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
        $apiKey = ApiKey::whereKey($key)->first();

        if ($apiKey) {
            return $apiKey->user;
        }
    }

    /**
     * Relationship with the ApiLog model.
     *
     * @return    Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(ApiLog::class, 'user_id');
    }

    /**
     * Relationship with the ApiKey model.
     *
     * @return    Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apikeys()
    {
        return $this->hasMany(ApiKey::class);
    }

}
