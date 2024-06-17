<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\Product\ProductRequest;

class ProductUpdateRequest extends ProductRequest
{

	public function rules()
	{
		$this->rules['file'] = ['nullable', 'image'];
		if(!$this->hasFile('file')){
			$this->rules['file'] = ['nullable'];
		}
		return $this->rules;
	}
}
