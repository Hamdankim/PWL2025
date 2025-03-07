<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($category)
    {
        $products = [
            'food-beverage' => [
                ['name' => 'Coca Cola', 'price' => 10000],
                ['name' => 'Indomie Goreng', 'price' => 3000],
            ],
            'beauty-health' => [
                ['name' => 'Face Wash', 'price' => 25000],
                ['name' => 'Shampoo', 'price' => 20000],
            ],
            'home-care' => [
                ['name' => 'Sabun Cuci Piring', 'price' => 15000],
                ['name' => 'Pewangi Ruangan', 'price' => 18000],
            ],
            'baby-kid' => [
                ['name' => 'Popok Bayi', 'price' => 50000],
                ['name' => 'Susu Formula', 'price' => 120000],
            ],
        ];
        

        if (!array_key_exists($category, $products)) {
            abort(404);
        }

        return view('product', [
            'category' => $category,
            'products' => $products[$category]
        ]);
    }
}