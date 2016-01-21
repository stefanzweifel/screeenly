<?php

namespace Screeenly;

use Illuminate\Database\Eloquent\Model;
use Screeenly\User;
use Screeenly\ApiLog;

class ApiKey extends Model
{
    protected $fillable = ['name', 'key', 'user_id'];

    protected $table = 'api_keys';

    /**
     * Relationship with the User model.
     *
     * @return    Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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

    /**
     * Generate a new unique API key
     * @return string
     */
    public function generateKey()
    {
        $key = str_random(50);

        if ( self::whereKey($key)->first() ) {
            return $this->generateKey();
        }

        return $key;
    }

}
