<?php

namespace App\Models\Request;

class CartItem
{
    public function __construct(
        public float $price,
        public string $productCode,
        public string $name,
    ) {
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
