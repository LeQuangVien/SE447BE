<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminKhachHang()
    {
        $khach_hang = KhachHang::get();
        return response()->json([
            'data'      => $khach_hang
        ]);
    }
    public function updateKhachHang(Request $request)
    {
        $khach_hang = KhachHang::where('id', $request->id)->first();
        if ($khach_hang) {
            $khach_hang->update([
                'email'             => $request->email,
                'so_dien_thoai'     => $request->so_dien_thoai,
                'ho_va_ten'         => $request->ho_va_ten,
            ]);
            return response()->json([
                'status' => true,
                'message' => "Đã đổi trạng thái tài khoản thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function deleteKhachHang(Request $request)
    {
        $khach_hang = KhachHang::where('id', $request->id)->first();
        if ($khach_hang) {
            $khach_hang->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã Xóa Thành Công!'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Không Thể Xóa!'
            ]);
        }
        $khach_hang->save();
    }

    public function changeKhachHang(Request $request)
    {
        $khach_hang = KhachHang::where('id', $request->id)->first();
        if ($khach_hang) {
            if ($khach_hang->is_active == 0) {
                $khach_hang->is_active = 1;
            } else {
                $khach_hang->is_active = 0;
            }
            $khach_hang->save();
            return response()->json([
                'status' => true,
                'message' => "Đã kích hoạt tài khoản thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function selectDonHang()
    {
        $data = DonHang::get();
        return response()->json([
            'data'      => $data
        ]);
    }

    public function changeTrangThaiDonHang(Request $request)
    {

        $Product = DonHang::where('id', $request->id)->first();
        if ($Product) {
            if ($Product->tinh_trang_don_hang == 0) {
                $Product->tinh_trang_don_hang = 1;
            } else {
                $Product->tinh_trang_don_hang = 0;
            }
            $Product->save();
            return response()->json([
                'status' => true,
                'message' => "Đã Thay Đổi Trạng Thái Thành Công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }

    public function changeTinhTrangThanhToan(Request $request)
    {
        $Product = DonHang::where('id', $request->id)->first();
        if ($Product) {
            if ($Product->is_thanh_toan == 0) {
                $Product->is_thanh_toan = 1;
            } else {
                $Product->is_thanh_toan = 0;
            }
            $Product->save();
            return response()->json([
                'status' => true,
                'message' => "Đã Thay Đổi Trạng Thái Thành Công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có lỗi xảy ra!"
            ]);
        }
    }
}
