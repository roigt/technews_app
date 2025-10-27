<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name'=>['required','string'],
            'email'=>['required','email'],
            'subject'=>['required','string'],
            'message'=>['required','string'],
        ];
    }

    public function messages(): array{
        return [
            'name.required'=>'Le nom est obligatoire',
            'email.required'=>"L' e-mail est obligatoire",
            'subject.required'=>'Le sujet est obligatoire',
            'message.required'=>'Le message est obligatoire',
        ];
    }
}
