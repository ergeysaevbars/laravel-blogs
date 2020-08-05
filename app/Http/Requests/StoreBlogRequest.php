<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'title' => ['required', 'max:255'],
            'category' => ['not_in:0'],
            'content' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Заголовок не может быть пустым",
            'title.max' => "Длина заголовка не должна превышать :max символов",
            'category.not_in' => "Не указана категория",
            'content.required' => "Содержимое не может быть пустым"
        ];
    }
}
