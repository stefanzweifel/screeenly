<?php

namespace Screeenly\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApiKey extends Model
{
    protected $fillable = ['name', 'key', 'user_id'];

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
     * Generate a new unique API key.
     *
     * @return string
     */
    public function generateKey()
    {
        $key = Str::random(50);

        if (self::where('key', $key)->first()) {
            return $this->generateKey();
        }

        return $key;
    }
}
