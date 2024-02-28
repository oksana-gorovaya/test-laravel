<?php

namespace App\Repositories;

use App\Models\Promo;

class PromoRepository
{
    public function findPromosByNameNadProductCode(string $name, string $productCode): array
    {
        return Promo::where('name', $name)->whereHas('products', function ($query) use ($productCode) {
            $query->where('product_code', $productCode);
        })->get()->all();
    }

    public function findMinItemQuantityByName(string $name): int
    {
        return (int) Promo::where('name', $name)->value('min_item_quantity');
    }

    public function findDiscountPercentByName(string $name): int
    {
        return (int) Promo::where('name', $name)->value('discount_percent');
    }
}
