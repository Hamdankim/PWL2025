<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'KTG001',
                'kategori_nama' => 'Elektronik',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'KTG002',
                'kategori_nama' => 'Pakaian',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'KTG003',
                'kategori_nama' => 'Makanan',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'KTG004',
                'kategori_nama' => 'Alat Tulis',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'KTG005',
                'kategori_nama' => 'Perabotan',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
