<?php

namespace App\Repositories;

use App\Enums\PricingRule;
use App\Models\Promo;

class PromoRepository
{
    public function findPromoByNameAndProductCode(PricingRule $name, string $productCode): ?Promo
    {
        return Promo::where('name', $name)
            ->whereHas('products', function ($query) use ($productCode) {
                $query->where('product_code', $productCode);
            })
            ->first();
    }
}
