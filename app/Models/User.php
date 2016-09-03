<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token', 'provider_id', 'provider'
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
     * Checks if a given Github User Id already exists
     * @param  integer $providerId
     * @return boolean
     */
    public static function githubUserExists($providerId)
    {
        return self::where('provider_id', $providerId)
            ->whereProvider('Github')
            ->exists();
    }

    /**
     * Return User for given Provider Id
     * @param  itneger $providerId
     * @throws Illuminate\Database\Eloquent\ModelNotFoundException
     * @return App\Models\User
     */
    public static function getByProviderId($providerId)
    {
        return self::where('provider_id', $providerId)->firstOrFail();
    }

    /**
     * Create a new User from a Laravel Socialite User
     * @param  \Laravel\Socialite\Two\User $user
     * @return App\Models\User
     */
    public static function createNewUserFromGithub(\Laravel\Socialite\Two\User $user)
    {
        $user = self::create([
            'token' => $user->token,
            'email' => $user->email,
            'provider_id' => $user->id,
            'provider' => 'Github'
        ]);

        // Raise NewGithubUserCreated

        return $user;
    }

}
