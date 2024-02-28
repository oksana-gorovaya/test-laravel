<?php

namespace App\Services\PricingRules;

use App\Enums\PricingRule;
use App\Models\Request\CartItem;
use App\Repositories\PromoRepository;
use Illuminate\Support\Collection;

class BuyOneGetOneFree implements PricingRuleInterface
{
    public function __construct(public PromoRepository $promoRepository)
    {
    }

    /**
     * @param Collection<CartItem> $productsInCart
     */
    public function isApplicable(Collection $productsInCart, CartItem $cartItem): bool
    {
        $promo = $this->promoRepository->findPromoByNameAndProductCode(PricingRule::BUY_ONE_GET_ONE_FREE, $cartItem->productCode);
        $productQuantity = $productsInCart->where('productCode', $cartItem->productCode)->count();

        return $promo !== null && ($productQuantity >= $promo->min_item_quantity);
    }

    /**
     * @param Collection<CartItem> $productsInCart
     *
     * @return Collection<CartItem> $productsInCart
     */
    public function apply(Collection $productsInCart, CartItem $cartItem): Collection
    {
        $promo = $this->promoRepository->findPromoByNameAndProductCode(PricingRule::BUY_ONE_GET_ONE_FREE, $cartItem->productCode);
        $promoProducts = $productsInCart->where('productCode', $cartItem->productCode)->toArray();

        foreach ($promoProducts as $index => $promoProduct) {
            $index++;
            if ($index % $promo->min_item_quantity === 0) {
                $copy = clone($cartItem);
                $promoProduct->setPrice($copy->price -= $cartItem->price / 100 * $promo->discount_percent);
            }
        }

        return $productsInCart;
    }
}
