<?php

namespace Screeenly;

use Illuminate\Database\Eloquent\SoftDeletes;
use Screeenly\ApiKey;
use Screeenly\Screenshot\Screenshot;
use Screeenly\User;

class APILog extends \Eloquent
{
    use SoftDeletes;

    protected $fillable = ['images'];

    protected $table = 'api_log';

    public static function store(Screenshot $screenshot, User $user)
    {
        $key = \Input::get('key', null);
        $apiKey = ApiKey::whereKey($key)->first();

        $log = new self();
        $log->images = $screenshot->storagePath;
        $log->user()->associate($user);

        if (!is_null($apiKey)) {
            $log->apiKey()->associate($apiKey);
        }

        $log->save();

        return $log;
    }

    /**
     * Relationships.
     **/
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship with the ApiKey model.
     *
     * @return    Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function apiKey()
    {
        return $this->belongsTo(ApiKey::class);
    }
}
