<?php namespace Screeenly\Screenshot;

use Validator, App;

class ScreenshotValidator
{
    private static $rules = [
        'key'    => 'required' ,
        'url'    => 'required|url',
        'width'  => 'integer',
        'height' => 'integer'
    ];

    private $header = ['Access-Control-Allow-Origin' => '*'];

    public function validate($data)
    {
        $validator = Validator::make( $data, static::$rules );

        if ($validator->fails()) {

            $messages = array_flatten($validator->messages());
            App::abort(400, "Validation Error: $messages[0]", $this->header);

        }
    }

}