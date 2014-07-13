<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class APILog extends \Eloquent {

    protected $fillable = [
        'user_id', 'payload', 'response', 'images'
    ];

    protected $table = 'api_log';

    use SoftDeletingTrait;

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