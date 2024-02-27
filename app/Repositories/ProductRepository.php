<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    public function createProduct(array $request): bool
    {
        $product = new Product();
        $product->fill($request);

        return $product->save();
    }

    public function getProducts(): Collection
    {
        return Product::all();
    }
}
