<?php

namespace Screeenly\Core\Validators;

class AvailableUrlValidator
{
    public function validate($attribute, $value, $parameters)
    {
        $request = curl_init($value);
        curl_setopt($request, CURLOPT_TIMEOUT, 5);
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($request, CURLOPT_NOBODY, true);

        $result = curl_exec($request);
        curl_close($request);

        if ($result === false) {
            return false;
        }

        return true;
    }
}
