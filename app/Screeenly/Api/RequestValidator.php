<?php namespace Screeenly\Api;

use Input, Validator, App;

class RequestValidator
{
    private static $rules = [
        'key'    => 'required' ,
        'url'    => 'required|url',
        'width'  => 'integer',
        'height' => 'integer'
    ];

    private $header = ['Access-Control-Allow-Origin' => '*'];

    /**
     * Set the dependencies.
     *
     * @return   void
     */
    public function __construct()
    {
        $this->validate();
    }

    public function validate()
    {
        $validator = Validator::make( Input::all(), static::$rules );

        if ($validator->fails()) {

            $messages = array_flatten($validator->messages());
            App::abort(400, 'Validation Error: ' . $messages[0], $this->header);

        }
    }

}