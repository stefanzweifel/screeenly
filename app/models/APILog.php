<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Screeenly\Screenshot\Screenshot;

class APILog extends \Eloquent {

    use SoftDeletingTrait;

    protected $fillable = ['images'];

    protected $table = 'api_log';

    public static function store(Screenshot $screenshot, $user)
    {
        $log = new self();
        $log->images = $screenshot->storagePath;
        $log->user()->associate($user);
        $log->save();

        return $log;
    }

    /**
    *
    * Relationships
    *
    **/

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }


}