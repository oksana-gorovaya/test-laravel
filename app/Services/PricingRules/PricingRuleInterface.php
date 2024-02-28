<?php

namespace App\Services\PricingRules;

use App\Models\Request\CartItem;
use Illuminate\Support\Collection;

interface PricingRuleInterface
{
    /**
     * @param Collection<CartItem> $productsInCart
     */
    public function isApplicable(Collection $productsInCart, CartItem $cartItem): bool;

    /**
     * @param Collection<CartItem> $productsInCart
     *
     * @return Collection<CartItem> $productsInCart
     */
    public function apply(Collection $productsInCart, CartItem $cartItem): Collection;
}
