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

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
