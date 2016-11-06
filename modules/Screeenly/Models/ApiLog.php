<?php

namespace Screeenly\Models;

use Illuminate\Database\Eloquent\Model;
use Screeenly\Models\ApiKey;
use Screeenly\Models\User;

class ApiLog extends Model
{
    protected $fillable = ['images', 'user_id'];

    protected $table = 'api_log';

    /**
     * Relationship with the ApiKey model.
     *
     * @return    Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apiKey()
    {
        return $this->belongsTo(ApiKey::class);
    }

    /**
     * Relationship with the User model.
     *
     * @return    Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
