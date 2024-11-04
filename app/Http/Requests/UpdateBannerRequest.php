<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBannerRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'required|',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tên là bắt buộc.',
            'title.string' => 'Tên phải là một chuỗi ký tự.',
            'title.max' => 'Tên không được vượt quá 255 ký tự.',
            'image.required' => 'Ảnh là bắt buộc.',
        ];
    }
}
