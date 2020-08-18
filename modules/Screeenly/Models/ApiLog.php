<?php

namespace Screeenly\Models;

use Illuminate\Database\Eloquent\Model;
use Screeenly\Entities\Screenshot;

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

    /**
     * Returns a Screenshot Instance for the generated image.
     * @return Screeenly\Entities\Screenshot
     */
    public function screenshot()
    {
        return new Screenshot($this->images);
    }
}
