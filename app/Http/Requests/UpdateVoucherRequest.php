<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cho phép tất cả các yêu cầu. Thay đổi nếu bạn có điều kiện phân quyền.
    }
}
