<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('MON')->insertOrIgnore([
            ['ma_mon' => 'MON001', 'ten_mon' => 'Espresso', 'don_gia' => 35000, 'mo_ta' => 'Double shot espresso', 'hinh_anh' => null, 'ma_danh_muc' => 'DM001', 'trang_thai' => 'active'],
            ['ma_mon' => 'MON002', 'ten_mon' => 'Americano', 'don_gia' => 40000, 'mo_ta' => 'Espresso, nước', 'hinh_anh' => null, 'ma_danh_muc' => 'DM001', 'trang_thai' => 'active'],
            ['ma_mon' => 'MON003', 'ten_mon' => 'Latte', 'don_gia' => 45000, 'mo_ta' => 'Espresso, sữa tươi', 'hinh_anh' => null, 'ma_danh_muc' => 'DM001', 'trang_thai' => 'active'],
            ['ma_mon' => 'MON004', 'ten_mon' => ':am ấm', 'don_gia' => 45000, 'mo_ta' => 'Espresso, sữa tươi, sữa đặc, kem béo', 'hinh_anh' => null, 'ma_danh_muc' => 'DM001', 'trang_thai' => 'active'],
            ['ma_mon' => 'MON005', 'ten_mon' => 'Salted Caramel', 'don_gia' => 50000, 'mo_ta' => 'Espresso, sữa tươi, caramel, kem mặn', 'hinh_anh' => null, 'ma_danh_muc' => 'DM001', 'trang_thai' => 'active'],
        ]);
    }
}
