<?php

namespace App\Mappers;

use App\Models\Request\CartItem;

class ScanRequestToCartItemMapper
{
    public function map(array $request): CartItem
    {
        return new CartItem(
            $request['price'],
            $request['product_code'],
            $request['name'],
        );
    }
}
