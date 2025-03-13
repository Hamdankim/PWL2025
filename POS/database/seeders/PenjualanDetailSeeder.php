<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Transaksi 1 (penjualan_id = 1)
            ['penjualan_id' => 1, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 2],
            ['penjualan_id' => 1, 'barang_id' => 2, 'harga' => 75000, 'jumlah' => 1],
            ['penjualan_id' => 1, 'barang_id' => 3, 'harga' => 30000, 'jumlah' => 3],
        
            // Transaksi 2 (penjualan_id = 2)
            ['penjualan_id' => 2, 'barang_id' => 2, 'harga' => 75000, 'jumlah' => 2],
            ['penjualan_id' => 2, 'barang_id' => 3, 'harga' => 30000, 'jumlah' => 1],
            ['penjualan_id' => 2, 'barang_id' => 4, 'harga' => 60000, 'jumlah' => 2],
        
            // Transaksi 3 (penjualan_id = 3)
            ['penjualan_id' => 3, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 1],
            ['penjualan_id' => 3, 'barang_id' => 4, 'harga' => 60000, 'jumlah' => 3],
            ['penjualan_id' => 3, 'barang_id' => 5, 'harga' => 45000, 'jumlah' => 2],
        
            // Transaksi 4 (penjualan_id = 4)
            ['penjualan_id' => 4, 'barang_id' => 3, 'harga' => 30000, 'jumlah' => 2],
            ['penjualan_id' => 4, 'barang_id' => 5, 'harga' => 45000, 'jumlah' => 1],
            ['penjualan_id' => 4, 'barang_id' => 6, 'harga' => 70000, 'jumlah' => 2],
        
            // Transaksi 5 (penjualan_id = 5)
            ['penjualan_id' => 5, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 2],
            ['penjualan_id' => 5, 'barang_id' => 2, 'harga' => 75000, 'jumlah' => 1],
            ['penjualan_id' => 5, 'barang_id' => 6, 'harga' => 70000, 'jumlah' => 2],
        
            // Transaksi 6 (penjualan_id = 6)
            ['penjualan_id' => 6, 'barang_id' => 2, 'harga' => 75000, 'jumlah' => 3],
            ['penjualan_id' => 6, 'barang_id' => 3, 'harga' => 30000, 'jumlah' => 2],
            ['penjualan_id' => 6, 'barang_id' => 5, 'harga' => 45000, 'jumlah' => 1],
        
            // Transaksi 7 (penjualan_id = 7)
            ['penjualan_id' => 7, 'barang_id' => 3, 'harga' => 30000, 'jumlah' => 1],
            ['penjualan_id' => 7, 'barang_id' => 4, 'harga' => 60000, 'jumlah' => 2],
            ['penjualan_id' => 7, 'barang_id' => 6, 'harga' => 70000, 'jumlah' => 3],
        
            // Transaksi 8 (penjualan_id = 8)
            ['penjualan_id' => 8, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 1],
            ['penjualan_id' => 8, 'barang_id' => 5, 'harga' => 45000, 'jumlah' => 2],
            ['penjualan_id' => 8, 'barang_id' => 6, 'harga' => 70000, 'jumlah' => 1],
        
            // Transaksi 9 (penjualan_id = 9)
            ['penjualan_id' => 9, 'barang_id' => 2, 'harga' => 75000, 'jumlah' => 2],
            ['penjualan_id' => 9, 'barang_id' => 4, 'harga' => 60000, 'jumlah' => 1],
            ['penjualan_id' => 9, 'barang_id' => 5, 'harga' => 45000, 'jumlah' => 3],
        
            // Transaksi 10 (penjualan_id = 10)
            ['penjualan_id' => 10, 'barang_id' => 1, 'harga' => 50000, 'jumlah' => 2],
            ['penjualan_id' => 10, 'barang_id' => 3, 'harga' => 30000, 'jumlah' => 1],
            ['penjualan_id' => 10, 'barang_id' => 6, 'harga' => 70000, 'jumlah' => 2],
        ];        

        DB::table('t_penjualan_detail')->insert($data);        
    }
}
