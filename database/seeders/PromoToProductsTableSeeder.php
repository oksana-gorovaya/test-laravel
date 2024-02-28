<?php

namespace Database\Seeders;

use App\Enums\PricingRule;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoToProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::where('product_code', 'FR1')->firstOrFail();
        $promo = Promo::where('name', PricingRule::BUY_ONE_GET_ONE_FREE)->firstOrFail();

        DB::table('promo_to_products')->insert([
            'product_id' => $product->id,
            'promo_id' => $promo->id,
        ]);

        $product = Product::where('product_code', 'SR1')->firstOrFail();
        $promo = Promo::where('name', PricingRule::BULK_PURCHASE)->firstOrFail();

        DB::table('promo_to_products')->insert([
            'product_id' => $product->id,
            'promo_id' => $promo->id,
        ]);
    }
}
