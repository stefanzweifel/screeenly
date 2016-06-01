<?php

namespace Screeenly\Http\Requests;

use Screeenly\Http\Requests\Request;

class TryRequest extends Request
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
            'proof' => 'required',
            'url' => 'required|url'
        ];
    }
}
