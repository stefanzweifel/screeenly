<?php

namespace Screeenly\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider_id', 'provider',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Checks if a given Github User Id already exists.
     * @param  int $providerId
     * @return bool
     */
    public static function githubUserExists($providerId)
    {
        return self::where('provider_id', $providerId)
            ->whereProvider('Github')
            ->exists();
    }

    /**
     * Return User for given Provider Id.
     * @param  itneger $providerId
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     * @return App\Models\User
     */
    public static function getByProviderId($providerId)
    {
        return self::where('provider_id', $providerId)->firstOrFail();
    }

    /**
     * Create a new User from a Laravel Socialite User.
     * @param  string $email
     * @param  string $providerId
     * @return App\Models\User
     */
    public static function createNewUserFromGithub($email, $providerId)
    {
        $user = self::create([
            'email' => $email,
            'provider_id' => $providerId,
            'provider' => 'Github',
        ]);

        return $user;
    }

    /**
     * Relationship with the ApiKey model.
     *
     * @return    Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apiKeys()
    {
        return $this->hasMany(ApiKey::class);
    }

    /**
     * Relationship with the ApiLog model.
     *
     * @return    Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apiLogs()
    {
        return $this->hasMany(ApiLog::class);
    }
}
