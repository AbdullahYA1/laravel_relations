<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [ 'id' => 1, 'name' => 'Wireless Headphones', 'category' => 'Electronics', 'price' => 79.99, 'stock' => 45, 'active' => true ],
            [ 'id' => 2, 'name' => 'Cotton T-Shirt', 'category' => 'Clothing', 'price' => 29.99, 'stock' => 120, 'active' => true ],
            [ 'id' => 3, 'name' => 'Water Bottle', 'category' => 'Home', 'price' => 24.99, 'stock' => 0, 'active' => false ],
            [ 'id' => 4, 'name' => 'Leather Wallet', 'category' => 'Accessories', 'price' => 49.99, 'stock' => 30, 'active' => true ],
            [ 'id' => 5, 'name' => 'Fitness Watch', 'category' => 'Electronics', 'price' => 199.99, 'stock' => 15, 'active' => true ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['id' => $p['id']], $p);
        }
    }
}
