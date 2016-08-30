<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateInmueblesRequest extends Request {

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
            'estado' => 'required', 
            'operacion' => 'required', 
            'precio' => 'numeric', 
            'precio_min' => 'numeric', 
			'precio_alquiler' => 'numeric',
            'm2_construidos' => 'numeric', 
            'm2_utiles' => 'numeric', 
            'm2_parcela' => 'numeric', 
            'm2_terraza' => 'numeric', 
            'm2_patio' => 'numeric', 
		];
	}
}
