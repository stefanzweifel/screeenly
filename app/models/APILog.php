<?php

class APILog extends \Eloquent {

    protected $fillable = [
        'user_id', 'payload', 'response', 'images'
    ];

    protected $table = 'api_log';

    protected $softDelete = true;


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