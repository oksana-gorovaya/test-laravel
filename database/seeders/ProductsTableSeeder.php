<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'product_code' => 'FR1',
            'name' => 'Fruit tea',
            'price' => 3.11,
        ]);

        DB::table('products')->insert([
            'product_code' => 'SR1',
            'name' => 'Strawberries',
            'price' => 5,
        ]);

        DB::table('products')->insert([
            'product_code' => 'CF1',
            'name' => 'Coffee',
            'price' => 11.23,
        ]);
    }
}
