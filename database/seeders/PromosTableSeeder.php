<?php

namespace Database\Seeders;

use App\Enums\PricingRule;
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
            'name' => PricingRule::BUY_ONE_GET_ONE_FREE,
            'discount_percent' => 100,
            'min_item_quantity' => 2,
        ]);

        DB::table('promos')->insert([
            'name' => PricingRule::BULK_PURCHASE,
            'discount_percent' => 10,
            'min_item_quantity' => 3,
        ]);
    }
}
