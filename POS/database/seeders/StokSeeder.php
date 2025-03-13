<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'stok_id' => 1,
                'supplier_id' => 1,
                'barang_id' => 1,
                'user_id' => 1,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 50,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 2,
                'supplier_id' => 1,
                'barang_id' => 2,
                'user_id' => 1,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 40,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 3,
                'supplier_id' => 2,
                'barang_id' => 3,
                'user_id' => 2,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 60,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 4,
                'supplier_id' => 2,
                'barang_id' => 4,
                'user_id' => 2,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 45,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 5,
                'supplier_id' => 3,
                'barang_id' => 5,
                'user_id' => 3,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 100,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 6,
                'supplier_id' => 3,
                'barang_id' => 6,
                'user_id' => 3,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 80,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 7,
                'supplier_id' => 1,
                'barang_id' => 7,
                'user_id' => 1,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 120,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 8,
                'supplier_id' => 1,
                'barang_id' => 8,
                'user_id' => 1,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 90,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 9,
                'supplier_id' => 2,
                'barang_id' => 9,
                'user_id' => 2,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 110,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 10,
                'supplier_id' => 2,
                'barang_id' => 10,
                'user_id' => 2,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 70,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 11,
                'supplier_id' => 3,
                'barang_id' => 11,
                'user_id' => 3,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 85,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 12,
                'supplier_id' => 3,
                'barang_id' => 12,
                'user_id' => 3,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 95,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 13,
                'supplier_id' => 1,
                'barang_id' => 13,
                'user_id' => 1,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 130,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 14,
                'supplier_id' => 1,
                'barang_id' => 14,
                'user_id' => 1,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 140,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
            [
                'stok_id' => 15,
                'supplier_id' => 2,
                'barang_id' => 15,
                'user_id' => 2,
                'stok_tanggal' => '2025-03-09 17:32:54',
                'stok_jumlah' => 75,
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null
            ],
        ];
        DB::table('t_stok')->insert($data);
    }
}
