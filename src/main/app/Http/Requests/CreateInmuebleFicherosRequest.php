<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Marketingimage;

class CreateInmuebleFicherosRequest extends Request
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
				'image_name' => 'alpha_num | unique:marketing_images',
				'mobile_image_name' => 'alpha_num | unique:marketing_images',
				'is_active' => 'boolean',
				'is_featured' => 'boolean',
				'image' => 'mimes:jpeg,jpg,bmp,png | max:1000',
				'mobile_image' => 'mimes:jpeg,jpg,bmp,png | max:1000',
				'promocion_id' => 'required',
		];
	}
}
