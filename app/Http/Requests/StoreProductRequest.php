<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0|lt:price_regular',
            'quantity' => 'required|integer|min:0',
            'overview' => 'required|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    /**
     * Xác định các thông báo lỗi tùy chỉnh.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'sku.required' => 'SKU là bắt buộc.',
            'price_regular.required' => 'Giá thường là bắt buộc.',
            'price_sale.lt' => 'Giá sale phải thấp hơn giá thường.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'overview.required' => 'Tóm tắt là bắt buộc.',
            'content.required' => 'Nội dung là bắt buộc.',
            'category_id.required' => 'Danh mục là bắt buộc.',
            'category_id.exists' => 'Danh mục không tồn tại.',
        ];
    }
}
