<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('promos')->insert([
            'name' => 'buy-one-get-one-free',
            'discount_percent' => 100,
            'min_item_quantity' => 2,
        ]);

        DB::table('promos')->insert([
            'name' => 'bulk',
            'discount_percent' => 10,
            'min_item_quantity' => 3,
        ]);
    }
}
