<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChiTietDonHangController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DiaChiController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\TrangChuController;
use App\Models\DonHang;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/trang-chu/san-pham/select',                [TrangChuController::class, 'store']);
Route::get('/trang-chu/san-pham/selectProduct',         [TrangChuController::class, 'store']);
//Danh Mục
Route::get('/danh-muc/san-pham/select',                  [DanhMucController::class, 'storeDanhmuc']);
Route::get('/danh-muc/danh-sach-san-pham/select/{id}',   [DanhMucController::class, 'danhSachSanPham']);

// Route::get('danh-muc/trang-chu/select-san-pham',   [DanhMucController::class, 'danhmuctrangchu']);

//San Phẩm Chi Tiết
Route::get('san-pham/san-pham-chi-tiet/select/{id}',    [SanPhamController::class, 'store']);
Route::get('san-pham/san-pham-chi-tiet/select/xemthem', [SanPhamController::class, 'themSanPhamChiTiet']);

//Khách Hàng
Route::post('khach-hang/dang-ky/create',                [KhachHangController::class, 'create']);

Route::post('/khach-hang/login',                        [KhachHangController::class, 'loginUser']);
Route::post('/khach-hang/check-login',                  [KhachHangController::class, 'checkloginUser']);
Route::post('/khach-hang/check-email',                  [KhachHangController::class, 'checkEmail']);
Route::get('/khach-hang/dang-xuat',                     [KhachHangController::class, 'dangxuat']);
Route::get('/khach-hang/dang-xuat-tat-ca-thiet-bi',     [KhachHangController::class, 'dangXuatTatCaThietBi']);
Route::get('/khach-hang/thong-tin',                     [KhachHangController::class, 'thongTin']);
Route::post('/khach-hang/updateProfile',                [KhachHangController::class, 'updateProfile']);
Route::post('/khach-hang/updatePassword',               [KhachHangController::class, 'updatePassword']);
Route::get('/kich-hoat-tai-khoan/{id}',                 [TrangChuController::class, 'kichHoatTaiKhoan']);

//Admin
Route::post('/admin/login-nhan-vien',                        [NhanVienController::class, 'loginNhanVien']);
Route::post('/admin/check-login-nhan-vien',                  [NhanVienController::class, 'checkloginNhanVien']);


// Contacts
Route::post('/contact/khach-hang/create',               [ContactController::class, 'create']);
Route::get('/contact/khach-hang/select',                [ContactController::class, 'store']);


// Dia Chi
Route::post('dia-chi/create',                           [DiaChiController::class, 'create']);
// Route::get('dia-chi/select',                            [DiaChiController::class, 'store']);
// Route::post('dia-chi/updateDiaChi',                     [DiaChiController::class, 'updateDiaChi']);
// Route::post('dia-chi/detroys',                          [DiaChiController::class, 'destroy']);

//Chi Tiet Don Hang
Route::post('chi-tiet-don-hang/them-vao-gio-hang',      [ChiTietDonHangController::class, 'themVaoGioHang']);
Route::get('chi-tiet-don-hang/select-gio-hang',         [ChiTietDonHangController::class, 'store']);
Route::post('chi-tiet-don-hang/delete-san-pham-gio-hang', [ChiTietDonHangController::class, 'destroy']);
Route::post('chi-tiet-don-hang/update-gio-hang',        [ChiTietDonHangController::class, 'update']);
Route::post('/gio-hang/list-chon-san-pham',             [ChiTietDonHangController::class, 'listChon']);
Route::get('/gio-hang/gio-hang-thanh-toan',             [ChiTietDonHangController::class, 'giohang']);
Route::post('/gio-hang/delete/thanh-toan',              [ChiTietDonHangController::class, 'deleteThanhToan']);
// Thanh Toan Don Hang

Route::post('/don-hang/thanh-toan',                     [DonHangController::class, 'thanhToan']);



//Thông Tin Đơn Hàng Profile
Route::get('/profile/thong-tin-don-hang', [DonHangController::class, 'donHangProfile']);

//admin
/*AdminKhachHang*/
Route::get('/admin/thong-tin-khach-hang', [AdminController::class, 'adminKhachHang']);
Route::post('/admin/update-khach-hang', [AdminController::class, 'updateKhachHang']);
Route::post('/admin/delete-khach-hang', [AdminController::class, 'deleteKhachHang']);
Route::post('/admin/change-trang-thai-khach-hang', [AdminController::class, 'changeKhachHang']);

//admin don hang
Route::get('/admin/thong-tin-don-hang/khach-hang', [AdminController::class, 'selectDonHang']);
Route::post('/admin/change-tinh-trang-don-hang/changeTrangThaiDonHang', [AdminController::class, 'changeTrangThaiDonHang']);
Route::post('/admin/change-tinh-trang-thanh-toan/changeTinhTrangDonHang', [AdminController::class, 'changeTinhTrangThanhToan']);

// Tim Kiem sp
Route::post('/trang-chu/tim-kiem', [SanPhamController::class, 'timKiemTrangChu']);



Route::post('/xoa-don-hang/admin', [DonHangController::class, 'destroys']);
Route::get('/select-san-pham/admin', [SanPhamController::class, 'select']);
// Route::post('/update-san-pham/admin', [SanPhamController::class, 'update']);
Route::post('/xoa-san-pham/admin', [SanPhamController::class, 'destroys']);


// Route::post('/nhap-kho/cap-nhat-san-pham-nhap-kho', [SanPhamController::class, 'capNhatSanPhamNhapKho']);

Route::post('/profile/xoa-don-hang', [DonHangController::class, 'deleteProfile']);
