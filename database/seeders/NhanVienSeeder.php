<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhanVienSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('nhan_viens')->delete();
        DB::table('nhan_viens')->truncate();
        DB::table('nhan_viens')->insert([
            [
                'email'             =>  'lequangvien@gmail.com',
                'password'          =>  bcrypt('123456'),
                'ho_va_ten'         =>  'Lê Quang Viên',
                'so_dien_thoai'     =>  '0905.523.543',
                'dia_chi'           =>  'Đà Nẵng',
                'tinh_trang'        =>  1,
            ],
        ]);
    }
}
