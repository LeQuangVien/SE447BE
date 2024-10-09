<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\KhachHang;
use Illuminate\Http\Request;

class TrangChuController extends Controller
{
    public function store()
    {
        $dulieu = SanPham::orderByDESC('id')
            ->take(9)
            ->get();
        $newArrivals = SanPham::orderByDESC('id')
            ->take(3)
            ->get();
        $allProducts = SanPham::get();
        return response()->json([
            'data' => $dulieu,
            'allProducts' => $allProducts,
            'newArrivals' => $newArrivals,
        ]);
    }


    public function kichHoatTaiKhoan($hash_active)
    {
        $tai_khoan = KhachHang::where('hash_active', $hash_active)->where('is_active', 0)->first();

        if ($tai_khoan) {
            $tai_khoan->is_active = 1;
            $tai_khoan->hash_active = null;
            $tai_khoan->save();

            return response()->json([
                'status' => true,
                'message' => "Bạn đã kích hoạt tài khoản thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Tài khoản bạn đã được kích hoạt hoặc không tồn tại!"
            ]);
        }
    }
}
