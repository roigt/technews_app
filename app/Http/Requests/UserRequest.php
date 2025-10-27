<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users,email',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => "Le nom du réseau social est obligatoire." ,
            'email.required'    => "Le lien est obligatoire.",
            'email.email'       => "L'adresse email est invalide.",
        ];
    }


}
