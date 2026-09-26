<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('products')->insert([
            [
                'category_id' => 1,
                'code' => 'P001',
                'name' => 'Product 1',
                'unit' => 'pcs',
                'price' => 10000,
                'stock' => 50,
            ],
            [
                'category_id' => 2,
                'code' => 'P002',
                'name' => 'Product 2',
                'unit' => 'pcs',
                'price' => 20000,
                'stock' => 30,
            ],
            [
                'category_id' => 3,
                'code' => 'P003',
                'name' => 'Product 3',
                'unit' => 'pcs',
                'price' => 15000,
                'stock' => 20,
            ],
        ]);
    }
}