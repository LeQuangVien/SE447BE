<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten_san_pham');
            $table->string('slug_san_pham');
            $table->text('hinh_anh');
            $table->integer('gia_ban');
            $table->integer('gia_khuyen_mai');
            $table->string('mo_ta_ngan');
            $table->string('mo_ta_thu_nhat');
            $table->string('mo_ta_thu_hai');
            $table->string('mo_ta_thu_ba');
            $table->integer('id_danh_muc')->nullable();
            $table->integer('tinh_trang')->default(0);
            $table->integer('so_luong')->default(0);
            $table->string('thuong_hieu');
            $table->string('ghi_chu')->nullable();
            $table->string('size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
