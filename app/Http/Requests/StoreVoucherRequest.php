<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoucherRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép tất cả các yêu cầu. Thay đổi nếu bạn có điều kiện phân quyền.
    }

    public function rules()
    {
        return [
            'code' => 'required|string|max:255|unique:vouchers,code',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'expires_at' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Mã voucher là bắt buộc.',
            'code.unique' => 'Mã voucher đã tồn tại.',
            'type.required' => 'Loại voucher là bắt buộc.',
            'type.in' => 'Loại voucher không hợp lệ.',
            'value.required' => 'Giá trị voucher là bắt buộc.',
            'value.numeric' => 'Giá trị voucher phải là số.',
            'expires_at.required' => 'Ngày hết hạn là bắt buộc.',
            'expires_at.date' => 'Ngày hết hạn không hợp lệ.',
            'expires_at.after_or_equal' => 'Ngày hết hạn phải là ngày hôm nay hoặc trong tương lai.',
        ];
    }
}
