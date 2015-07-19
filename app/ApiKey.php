<?php

namespace Screeenly;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Screeenly\User;
use Screeenly\ApiLog;

class ApiKey extends Model
{
    use SoftDeletes;

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
        return str_random(50);
    }

}
