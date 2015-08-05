<?php

namespace Screeenly\Core\Requests;

use Screeenly\Http\Requests\Request;

class ApiRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'key'    => ['required', 'exists:api_keys,key'],
            'url'    => ['required', 'url' , 'available_url'], // Is 'active_url' reliable enough?
            'width'  => 'integer',
            'height' => 'integer'
        ];
    }
}
