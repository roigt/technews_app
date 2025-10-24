<?php

namespace App\Http\Requests\article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title' =>['required','string','max:255'],
            'description' =>['required','string'],
            'image' =>['required','file','mimes:jpeg,jpg,png,gif','max:2048','nullable'],
            'isComment' =>['required','boolean'],
            'isSharable' =>['required','boolean'],
            'isActive' =>['required','boolean'],
            'category_id' =>['required','integer','exists:categories,id'],
            'tags' =>['string','nullable'],
        ];
    }
}
