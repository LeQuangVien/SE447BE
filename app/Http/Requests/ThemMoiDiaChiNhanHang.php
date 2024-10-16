<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemMoiDiaChiNhanHang extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ten_nguoi_nhan'         =>  'required|min:4|max:100',
            'email'             =>  'required|email|unique:khach_hangs,email',
            'so_dien_thoai'     =>  'required|digits:10',
            'dia_chi'          =>  'required|min:6|max:50',
        ];
    }


    public function messages()
    {
        return [
            'ten_nguoi_nhan.*'         =>  'Họ và tên phải từ 4 đến 100 ký tự',
            'email.*'             =>  'Email không đúng định dạng',
            'so_dien_thoai.*'     =>  'Số điện thoại phải 10 số',
            'dia_chi.*'          =>  'Địa chỉ phải từ 6 đến 50 ký tự',
        ];
    }
}
