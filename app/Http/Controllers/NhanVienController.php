<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NhanVienController extends Controller
{
    public function loginNhanVien(Request $request)
    {
        $check  = Auth::guard('nhan_vien')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($check) {
            $user   =   Auth::guard('nhan_vien')->user();
            if ($user->tinh_trang == 0) {
                return response()->json([
                    'message'  =>   'Tài khoản của bạn đã bị khóa!',
                    'status'   =>   2
                ]);
            } else {
                return response()->json([
                    'message'   =>   'Đã đăng nhập thành công!',
                    'status'    =>   1,
                    'chia_khoa' =>   $user->createToken('ma_so_bi_mat_nhan_vien')->plainTextToken,
                    'ten_admin' =>   $user->ho_va_ten
                ]);
            }
        } else {
            return response()->json([
                'message'  =>   'Tài khoản hoặc mật khẩu không đúng!',
                'status'   =>   false
            ]);
        }
    }
    public function checkloginNhanVien()
    {
        $check  = $this->isUserNhanVien();
        if ($check) {
            return response()->json([
                'status'   =>   true,
                'message'  =>   'Ok, bạn có thể đi qua!',
            ]);
        } else {
            return response()->json([
                'status'   =>   false,
                'message'  =>   'Bạn chưa đăng nhập tài khoản nhân viên!',
            ]);
        }
    }
}
