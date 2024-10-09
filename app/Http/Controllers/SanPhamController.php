<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function store($id)
    {
        $sanPham = SanPham::where('id', $id)->first();
        if ($sanPham) {
            return response()->json([
                'status' => true,
                'data'   => $sanPham,
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => "Không Có Sản Phẩm!"
            ]);
        }
    }
    public function timKiemTrangChu(Request $request)
    {
        $tim_kiem = "%" . $request->thong_tin_tim . "%";

        $data   = SanPham::where('ten_san_pham', "like", $tim_kiem)->get();
        // $danh_muc = $danh_muc =  DanhMuc::where('id', $request->id)->first();

        return response()->json([
            'data' => $data,
            // 'danh_muc' => $danh_muc
        ]);
    }
    // public function themSanPhamChiTiet()
    // {
    //     $sanPham = SanPham::orderByDESC('gia_khuyen_mai')
    //         ->take(3)
    //         ->get();
    //     return response()->json([
    //         'data'  => $sanPham
    //     ]);
    // }
}
