<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThemMoiDiaChiNhanHang;
use App\Models\ChiTietDonHang;
use App\Models\DiaChi;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{

    public function thanhToan(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();
        $dia_chi = DiaChi::orderByDESC('id')
            ->take(1)
            ->where('id_khach_hang', $khach_hang->id)->first();
        if (!$dia_chi) {
            return response()->json([
                'status' => false,
                'message' => "Vui Lòng Gửi Địa Chỉ"
            ]);
        } else if (count($request->ds_mua_sp) < 1) {
            return response()->json([
                'status' => false,
                'message' => "Hãy Chọn 1 Sản Phẩm Trước Khi Mua"
            ]);
        } else {
            $don_hang = DonHang::create([
                'ma_don_hang'               => "",
                'tong_tien_thanh_toan'      => 0,
                'is_thanh_toan'             => 0,
                'tinh_trang_don_hang'       => 0,
                'ten_nguoi_nhan'            => $dia_chi->ten_nguoi_nhan,
                'so_dien_thoai'             => $dia_chi->so_dien_thoai,
                'dia_chi_giao_hang'         => $dia_chi->dia_chi,
                'so_luong'                  => 0,
                'is_giao_kho'               => 0,
                'id_khach_hang'             => $khach_hang->id
            ]);

            $ma_don_hang = "HDBH" . (101086 + $don_hang->id);
            $tong_tien_thanh_toan = 0;
            $so_luong = 0;
            foreach ($request->ds_mua_sp as $key => $value) {
                $tong_tien_thanh_toan += $value['thanh_tien'];
                $so_luong += $value['so_luong'];
                ChiTietDonHang::where('id', $value['id'])->update([
                    'id_hoa_don'    => $don_hang->id,
                ]);
            };

            $don_hang->ma_don_hang = $ma_don_hang;
            $don_hang->tong_tien_thanh_toan = $tong_tien_thanh_toan;
            $don_hang->so_luong = $so_luong;
            $don_hang->save();
            $dia_chi->delete();

            return response()->json([
                'status' => true,
                'message' => "Đặt đơn hàng thành công"
            ]);
        }
    }




    public function donHangProfile(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();
        $donhang = DonHang::where('id_khach_hang', $khach_hang->id)->get();
        return response()->json([
            'data'      => $donhang
        ]);
    }


    public function destroys(Request $request)
    {
        $don_hang = DonHang::where('id', $request->id)->first();
        if ($don_hang) {
            $don_hang->delete();
            return response([
                'status'  => true,
                'message' => 'Đã Xóa Thành Công'
            ]);
            $don_hang->save();
        } else {
            return response([
                'status'  => false,
                'message' => 'Xóa Thất Bại'
            ]);
        }
    }

    public function deleteProfile(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $products = DonHang::where('id', $request->id)->where('id_khach_hang', $user->id)->first();
        if ($products) {
            $products->delete();
            return response([
                'status'  => true,
                'message' => 'Đã Xóa Thành Công'
            ]);
            $products->save();
        } else {
            return response([
                'status'  => false,
                'message' => 'Xóa Thất Bại'
            ]);
        }
    }
}
