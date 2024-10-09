<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'san_phams';
    protected $fillable = [
        'ten_san_pham',
        'slug_san_pham',
        'hinh_anh',
        'gia_ban',
        'gia_khuyen_mai',
        'mo_ta_ngan',
        'mo_ta_thu_nhat',
        'mo_ta_thu_hai',
        'mo_ta_thu_ba',
        'id_danh_muc',
        'tinh_trang',
        'so_luong',
        'thuong_hieu',
        'ghi_chu',
        'size',
    ];
}
