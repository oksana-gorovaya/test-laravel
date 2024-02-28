<?php

namespace App\Services\PricingRules;

use App\Repositories\PromoRepository;
use Illuminate\Support\Collection;

class BulkPurchase
{
    public function __construct(public PromoRepository $promoRepository)
    {
    }

    public function isApplicable(Collection $productsInCart, $cartItem): bool
    {
        $promos = $this->promoRepository->findPromosByNameNadProductCode('bulk', $cartItem->productCode);
        $productQuantity = $productsInCart->where('productCode', $cartItem->productCode)->count();

        return count($promos) > 0 && $productQuantity >= $this->promoRepository->findMinItemQuantityByName('bulk');
    }

    public function apply(Collection $productsInCart, $cartItem): Collection
    {
        $promoProducts = $productsInCart->where('productCode', $cartItem->productCode)->all();
        foreach ($promoProducts as $promoProduct) {
            $promoProduct->price -= $cartItem->price / 100 * $this->promoRepository->findDiscountPercentByName('bulk');
        }

        return $productsInCart;
    }
}
