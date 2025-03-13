<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'level_id' => 1,
                'level_kode' => 'ADM',
                'level_nama' => 'Administrator',
                'created_at' => '2025-03-09 10:32:53',
                'updated_at' => null,
            ],
            [
                'level_id' => 2,
                'level_kode' => 'MNG',
                'level_nama' => 'Manager',
                'created_at' => '2025-03-09 10:32:53',
                'updated_at' => null,
            ],
            [
                'level_id' => 3,
                'level_kode' => 'STF',
                'level_nama' => 'Staff/Kasir',
                'created_at' => '2025-03-09 10:32:53',
                'updated_at' => null,
            ],
            [
                'level_id' => 4,
                'level_kode' => 'CUS2',
                'level_nama' => 'Customer',
                'created_at' => '2025-03-09 10:33:44',
                'updated_at' => '2025-03-09 10:33:50',
            ],
        ];
        DB::table('m_level')->insert($data);
    }
}
