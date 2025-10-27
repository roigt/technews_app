<?php

namespace App\Http\Requests\SocialMedia;

use Illuminate\Foundation\Http\FormRequest;

class StoreSocialMediaRequest extends FormRequest
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
            'name' => ['required','string'],
            'link' => ['required','string'],
            'icon' => ['required','string'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'    => "Le nom du réseau social est obligatoire." ,
            'link.required'    => "Le lien est obligatoire.",
            'icon.required'       => "Le nom de l icon est invalide.",
        ];
    }
}
