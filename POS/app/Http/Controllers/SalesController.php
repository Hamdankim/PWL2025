<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        // Simulasi daftar produk (tanpa database)
        $products = [
            ['name' => 'Coca Cola', 'price' => 10000],
            ['name' => 'Indomie Goreng', 'price' => 3000],
            ['name' => 'Sabun Cuci Piring', 'price' => 15000],
            ['name' => 'Popok Bayi', 'price' => 50000],
        ];

        return view('sales', compact('products'));
    }
}
