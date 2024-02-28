<?php

namespace App\Services\PricingRules;

use App\Enums\PricingRule;
use App\Models\Product;
use App\Models\Request\CartItem;
use App\Repositories\PromoRepository;
use Illuminate\Support\Collection;

class BulkPurchase implements PricingRuleInterface
{
    public function __construct(public PromoRepository $promoRepository)
    {
    }

    /**
     * @param Collection<CartItem> $productsInCart
     */
    public function isApplicable(Collection $productsInCart, CartItem $cartItem): bool
    {
        $promo = $this->promoRepository->findPromoByNameAndProductCode(PricingRule::BULK_PURCHASE, $cartItem->productCode);
        $productQuantity = $productsInCart->where('productCode', $cartItem->productCode)->count();

        return $promo !== null && $productQuantity >= $promo->min_item_quantity;
    }

    /**
     * @param Collection<Product> $productsInCart
     *
     * @return Collection<CartItem> $productsInCart
     */
    public function apply(Collection $productsInCart, CartItem $cartItem): Collection
    {
        $promo = $this->promoRepository->findPromoByNameAndProductCode(PricingRule::BULK_PURCHASE, $cartItem->productCode);
        $promoProducts = $productsInCart->where('productCode', $cartItem->productCode)->all();
        foreach ($promoProducts as $promoProduct) {
            $promoProduct->price -= $cartItem->price / 100 * $promo->discount_percent;
        }

        return $productsInCart;
    }
}
