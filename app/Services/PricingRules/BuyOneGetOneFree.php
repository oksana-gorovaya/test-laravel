<?php

namespace App\Services\PricingRules;

use App\Models\Request\CartItem;
use App\Repositories\PromoRepository;
use Illuminate\Support\Collection;

class BuyOneGetOneFree
{
    public function __construct(public PromoRepository $promoRepository)
    {
    }

    public function isApplicable(Collection $productsInCart, CartItem $cartItem): bool
    {
        $promos = $this->promoRepository->findPromosByNameNadProductCode('buy-one-get-one-free', $cartItem->productCode);
        $productQuantity = $productsInCart->where('productCode', $cartItem->productCode)->count();

        return count($promos) > 0 && ($productQuantity >= $this->promoRepository->findMinItemQuantityByName('buy-one-get-one-free'));
    }

    public function apply(Collection $productsInCart, CartItem $cartItem): Collection
    {
        $promoProducts = $productsInCart->where('productCode', $cartItem->productCode)->toArray();
        $minItemQuantity = $this->promoRepository->findMinItemQuantityByName('buy-one-get-one-free');
        $discountPercent = $this->promoRepository->findDiscountPercentByName('buy-one-get-one-free');

        foreach ($promoProducts as $index => $promoProduct) {
            $index++;
            if ($index % $minItemQuantity === 0) {
                $copy = clone($cartItem);
                $promoProduct->setPrice($copy->price -= $cartItem->price / 100 * $discountPercent);
            }
        }

        return $productsInCart;
    }
}
