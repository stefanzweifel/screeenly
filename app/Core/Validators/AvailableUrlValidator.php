<?php

namespace Screeenly\Core\Validators;

use Screeenly\Core\Ping;

class AvailableUrlValidator
{
    public function validate($attribute, $value, $parameters)
    {
        $ping = app()->make(Ping::class);

        return $ping->isUp($value);
    }
}
