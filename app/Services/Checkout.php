<?php

namespace App\Services;

use App\Models\Request\CartItem;
use Illuminate\Support\Collection;

class Checkout
{
    private Collection $productsInCart;
    private float $total = 0;

    public function __construct(public array $pricingRules
    ) {
        $this->productsInCart = new Collection();
    }

    public function scan(CartItem $item): void
    {
        $this->productsInCart->add($item);

            foreach ($this->pricingRules as $pricingRule) {
                if ($pricingRule->isApplicable($this->productsInCart, $item)) {
                    $this->productsInCart = $pricingRule->apply($this->productsInCart, $item);
                }
            }

        $this->total = $this->productsInCart->sum(fn ($product) => $product->price);
    }

    public function getTotal(): float
    {
        return $this->total;
    }
}
