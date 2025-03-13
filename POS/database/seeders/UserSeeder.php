<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'level_id' => 1,
                'username' => 'admin',
                'nama' => 'Administrator',
                'password' => '$2y$12$8bIWy6F4i6b1T3c9Ww3I4uaZPQP4Q405xZC/ns0BXn9hwduskwWwC',
                'created_at' => '2025-03-09 10:32:53',
                'updated_at' => null,
            ],
            [
                'user_id' => 2,
                'level_id' => 2,
                'username' => 'manager',
                'nama' => 'Manager',
                'password' => '$2y$12$v6aTF8wtrBH82N95.CNtbes4jbETPma7CAGbjGsY0h8jQm5YzztEq',
                'created_at' => '2025-03-09 10:32:53',
                'updated_at' => null,
            ],
            [
                'user_id' => 3,
                'level_id' => 3,
                'username' => 'staff',
                'nama' => 'Staff/Kasir',
                'password' => '$2y$12$0i7kRrj3vOHpVEu3LcK/BeEjJirVukCyW80WyJ58TmpolgNtWOhCy',
                'created_at' => '2025-03-09 10:32:54',
                'updated_at' => null,
            ]
        ];
        DB::table('m_user')->insert($data);
    }
}
