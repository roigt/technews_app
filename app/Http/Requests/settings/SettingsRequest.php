<?php

namespace App\Http\Requests\settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'web_site_name'=>['required','string'],
            'logo'=>['image','nullable','mimes:png,jpg,jpeg','max:2048'],
            'address'=>['nullable','string'],
            'phone'=>['nullable','string'],
            'email'=>['nullable','string'],
            'about'=>['required','string'],
        ];
    }

    public function messages(): array
    {
        return [
            'web_site_name.required'    => "Le nom du site est obligatoire." ,
        ];
    }
}
