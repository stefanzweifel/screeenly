<?php

namespace Screeenly;

use Illuminate\Database\Eloquent\SoftDeletes;
use Screeenly\Screenshot\Screenshot;

class APILog extends \Eloquent
{
    use SoftDeletes;

    protected $fillable = ['images'];

    protected $table = 'api_log';

    public static function store(Screenshot $screenshot, User $user)
    {
        $log = new self();
        $log->images = $screenshot->storagePath;
        $log->user()->associate($user);
        $log->save();

        return $log;
    }

    /**
     * Relationships.
     **/
    public function user()
    {
        return $this->belongsTo('Screeenly\User', 'user_id');
    }
}
