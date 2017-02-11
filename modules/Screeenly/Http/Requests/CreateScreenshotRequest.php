<?php

namespace Screeenly\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateScreenshotRequest extends FormRequest
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
            'url'    => ['required', 'url'], // Is 'active_url' reliable enough?
            'width'  => ['sometimes', 'required', 'integer', 'max:2000', 'min:10'],
            'height' => ['sometimes', 'required', 'integer', 'min:10'],
            'delay'  => ['sometimes', 'required', 'integer', 'max:10', 'min:0'],
        ];
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        if ($this->is('api/v1/*')) {
            return [
                'title'   => 'An error accoured',
                'message' => 'Validation Error: '.$validator->getMessageBag()->first(),
            ];
        }

        return $validator->getMessageBag()->toArray();
    }
}
