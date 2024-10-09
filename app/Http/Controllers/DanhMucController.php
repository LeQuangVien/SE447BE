<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\SanPham;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function danhSachSanPham($id)
    {
        $data = SanPham::where('id_danh_muc', $id)
            ->where('tinh_trang', 1)
            ->get();
        $danh_muc =  DanhMuc::where('id', $id)->first();
        return response()->json([
            'data'      => $data,
            'danh_muc'  => $danh_muc
        ]);
    }
    public function storeDanhmuc()
    {
        $data = DanhMuc::where('tinh_trang', 1)->get();
        return response()->json([
            'data'   => $data
        ]);
    }
}
