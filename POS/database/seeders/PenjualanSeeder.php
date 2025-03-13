<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'Andi',
                'penjualan_kode' => 'TRX001',
                'penjualan_tanggal' => '2025-03-10 10:00:00',
                'created_at' => '2025-03-10 10:00:00',
                'updated_at' => NULL
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 2,
                'pembeli' => 'Budi',
                'penjualan_kode' => 'TRX002',
                'penjualan_tanggal' => '2025-03-10 10:05:00',
                'created_at' => '2025-03-10 10:05:00',
                'updated_at' => NULL
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Citra',
                'penjualan_kode' => 'TRX003',
                'penjualan_tanggal' => '2025-03-10 10:10:00',
                'created_at' => '2025-03-10 10:10:00',
                'updated_at' => NULL
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 1,
                'pembeli' => 'Dedi',
                'penjualan_kode' => 'TRX004',
                'penjualan_tanggal' => '2025-03-10 10:15:00',
                'created_at' => '2025-03-10 10:15:00',
                'updated_at' => NULL
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => 'Eka',
                'penjualan_kode' => 'TRX005',
                'penjualan_tanggal' => '2025-03-10 10:20:00',
                'created_at' => '2025-03-10 10:20:00',
                'updated_at' => NULL
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Fajar',
                'penjualan_kode' => 'TRX006',
                'penjualan_tanggal' => '2025-03-10 10:25:00',
                'created_at' => '2025-03-10 10:25:00',
                'updated_at' => NULL
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 1,
                'pembeli' => 'Gita',
                'penjualan_kode' => 'TRX007',
                'penjualan_tanggal' => '2025-03-10 10:30:00',
                'created_at' => '2025-03-10 10:30:00',
                'updated_at' => NULL
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 2,
                'pembeli' => 'Hadi',
                'penjualan_kode' => 'TRX008',
                'penjualan_tanggal' => '2025-03-10 10:35:00',
                'created_at' => '2025-03-10 10:35:00',
                'updated_at' => NULL
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Indra',
                'penjualan_kode' => 'TRX009',
                'penjualan_tanggal' => '2025-03-10 10:40:00',
                'created_at' => '2025-03-10 10:40:00',
                'updated_at' => NULL
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 1,
                'pembeli' => 'Joko',
                'penjualan_kode' => 'TRX010',
                'penjualan_tanggal' => '2025-03-10 10:45:00',
                'created_at' => '2025-03-10 10:45:00',
                'updated_at' => NULL
            ]
        ];

        DB::table('t_penjualan')->insert($data);        
    }
}
