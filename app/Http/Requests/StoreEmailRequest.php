<?php namespace Screeenly\Http\Requests;

use Screeenly\Http\Requests\Request;
use Auth;

class StoreEmailRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email' => ['required', 'email', 'unique:users,email']
		];
	}

}
