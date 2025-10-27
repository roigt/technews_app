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
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif'],
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
            'about.required'             => "La description du site est obligatoire.",
            'logo.image' => "Le fichier doit être une image valide (PNG, JPG, etc.).",
            'mimes'      => "Le logo doit être au format png, jpg, jpeg ou gif.",

        ];
    }
}
