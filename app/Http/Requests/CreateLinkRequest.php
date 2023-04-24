<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateLinkRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'link_purpose' => 'required|max:150',
			'link_amount' => 'required|numeric',
			'customer_phone' => 'required|digits:10',
			'customer_email' => 'nullable|email',
		];
	}

	public function attributes()
	{
		return [
			'link_purpose' => "Description",
			'link_amount' => "Amount",
			'customer_phone' => "Mobile Number",
			'customer_email' => "Email ID",
		];
	}
}
