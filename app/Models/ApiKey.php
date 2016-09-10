<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
