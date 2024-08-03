<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title' => ['required', 'min:10'],
            'image' => ['required', 'image'],
            'description' => ['required'],
            'content' => ['required', 'min:25'],
            'view' => ['required', 'integer', 'min:0']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Bạn phải nhập dữ liệu",
            'title.min' => 'Sos ký tự phải >= 10',
            'image.required' => "Bạn phải nhập ảnh",
            'image.image' => "Ảnh của bạn chưa đúng định dạng",
            'description.required' => "Bạn chưa nhập mô tả",
            'content.required' => "Bạn chưa nhập nội dung",
            'content.min' => "Số ký từ phải từ 25",
            'view.required' => "Bạn chưa nhập view",
            'view.integer' => "View phải là số nguyên",
            'view.min' => "View phải là số nguyên dương"
        ];
    }
}
