<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Intel Core i7 CPU',
            'category' => 'CPU',
            'price' => 15000,
            'stock' => 10,
            'speed' => '3.6 GHz'
        ]);

        Product::create([
            'name' => 'NVIDIA RTX 3060',
            'category' => 'GPU',
            'price' => 25000,
            'stock' => 5,
            'speed' => '1.7 GHz'
        ]);
    }
}
