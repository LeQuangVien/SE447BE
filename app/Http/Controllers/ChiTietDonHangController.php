<?php

namespace App\Http\Controllers;

use App\Models\ChiTietDonHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietDonHangController extends Controller
{
    public function themVaoGioHang(Request $request)
    {
        $khachhang = Auth::guard('sanctum')->user();
        $sanpham = SanPham::where('id', $request->id_san_pham)->first();
        if ($sanpham) {
            if ($sanpham->gia_khuyen_mai > 0) {
                $dongia = $sanpham->gia_khuyen_mai;
            } else {
                $dongia = $sanpham->gia_ban;
            }
            $tim = ChiTietDonHang::where('id_khach_hang', $khachhang->id)
                ->where('id_san_pham', $sanpham->id)
                ->whereNull('id_hoa_don')
                ->first();
            if ($tim) {
                $tim->so_luong   = $tim->so_luong + 1;
                $tim->thanh_tien = $tim->so_luong * $dongia;
                $tim->save();
            } else {
                ChiTietDonHang::create([
                    'id_khach_hang'     => $khachhang->id,
                    'id_san_pham'       => $sanpham->id,
                    'don_gia'           => $dongia,
                    'thanh_tien'        => $dongia * 1,
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => "Sản phẩm đã được thêm vào giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }
    public function deleteThanhToan(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $giohang = ChiTietDonHang::where('id', $request->id)->where('id_khach_hang', $user->id)
            // ->where('is_gio_hang', 1)
            ->first();
        if ($giohang) {
            $giohang->delete();
            return response()->json([
                'status' => true,
                'message' => "Sản phẩm đã được xóa khỏi vào giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function store()
    {
        $khachhang = Auth::guard('sanctum')->user();
        $data = ChiTietDonHang::where('id_khach_hang', $khachhang->id)
            ->join('san_phams', 'san_phams.id', 'chi_tiet_don_hangs.id_san_pham')
            ->select('san_phams.hinh_anh', 'san_phams.ten_san_pham', 'chi_tiet_don_hangs.*')
            ->whereNull('id_hoa_don')->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy(Request $request)
    {
        $khachhang = Auth::guard('sanctum')->user();
        $giohang = ChiTietDonHang::where('id', $request->id)->where('id_khach_hang', $khachhang->id)->first();
        if ($giohang) {
            $giohang->delete();
            return response()->json([
                'status' => true,
                'message' => "Sản phẩm đã được xóa khỏi vào giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }


    public function update(Request $request)
    {
        $khachhang = Auth::guard('sanctum')->user();
        $giohang = ChiTietDonHang::where('id', $request->id)->where('id_khach_hang', $khachhang->id)->first();
        if ($giohang) {
            $giohang->so_luong     = $request->so_luong;
            $giohang->size         = $request->size;
            $giohang->thanh_tien   = $request->so_luong * $giohang->don_gia;
            $giohang->ghi_chu      = $request->ghi_chu;
            $giohang->save();
            return response()->json([
                'status' => true,
                'message' => "Đã cập nhật giỏ hàng thành công!"
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => "Đã cập nhật giỏ hàng thành công!"
            ]);
        }
    }
    public function giohang(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        $data = ChiTietDonHang::where('id_khach_hang', $user->id)->where('is_gio_hang', 1)
            ->join('san_phams', 'san_phams.id', 'chi_tiet_don_hangs.id_san_pham')
            ->select('san_phams.hinh_anh', 'san_phams.ten_san_pham', 'chi_tiet_don_hangs.*')
            ->whereNull('id_hoa_don')->get();
        return response()->json([
            'data'   => $data
        ]);
    }


    public function listChon(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();
        // $sanpham = SanPham::where('id', $request->id_san_pham)->first();
        $check = ChiTietDonHang::where('id', $request->ds_mua_sp)->where('id', $khach_hang->id)->get();
        if ($check) {
            if (count($request->ds_mua_sp) < 1) {
                return response()->json([
                    'status' => false,
                    'message' => "Bạn dã chọn sản phẩm nào đâu mà mua"
                ]);
            } else {
                foreach ($request->ds_mua_sp as $key => $value) {
                    ChiTietDonHang::where('id', $value['id'])->update([
                        'is_gio_hang'    => 1,
                    ]);
                };
            }
        }
    }
}
