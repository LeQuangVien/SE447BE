<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use App\Models\DanhMuc;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function select()
    {
        $products = SanPham::get();
        return response()->json([
            'data'  => $products
        ]);
    }
    // public function update(Request $request)
    // {
    //     $products = SanPham::where('id', $request->id_san_pham)->first();
    //     if ($products) {
    //         $products->update([
    //             'ten_san_pham' => $request->ten_san_pham,
    //             'hinh_anh'      => $request->hinh_anh,
    //             'gia_ban'  => $request->gia_ban,
    //             'gia_khuyen_mai' => $request->gia_khuyen_mai,
    //             'mo_ta_ngan' => $request->mo_ta_ngan,
    //             'so_luong'  => $request->so_luong,
    //         ]);
    //     }
    // }

    public function destroys(Request $request)
    {
        $products = SanPham::where('id', $request->id)->first();
        if ($products) {
            $products->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'đã xóa thành công'
            ]);
            $products->save();
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'xóa không thành công'
            ]);
        }
    }

    public function timKiemTrangChu(Request $request)
    {
        $tim_kiem = "%" . $request->thong_tin_tim . "%";
        $data   = SanPham::where('ten_san_pham', "like", $tim_kiem)->get();
        return response()->json([
            'data' => $data,
        ]);
    }
}
