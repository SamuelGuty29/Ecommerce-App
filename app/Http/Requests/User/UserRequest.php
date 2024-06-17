<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    protected $rules = [
        'name' => ['required', 'string'],
        'last_name' => ['required', 'string'],
        'number_id' => ['required', 'numeric', 'unique:users,number_id'],
        'email' => ['required', 'email', 'unique:users,email'],
        'password' => ['required', 'confirmed', 'string', 'min:8'],        
    ];
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        if($this->path() != 'api/register'){
            $rules['role'] = ['required', 'string','in:user,admin'];
        }

        $this->rules['file'] = ['nullable', 'image'];

        if (!$this->hasFile('file')) {
            $this->rules['file'] = ['nullable'];
        }
        return $this->rules;
    }


	public function messages()
	{
		return [
			'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre debe ser valido',
			'last_name.required' => 'El apellido es requerido',
			'last_name.string' => 'El apellido debe ser valido',
			'email.required' => 'El email es requerido',
			'email.string' => 'El email debe ser valido',
			'password.required' => 'La contraseña es requerida',
			'password.string' => 'La contraseña debe ser valida',
		];
	}
}
