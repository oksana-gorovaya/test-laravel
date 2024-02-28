<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository
{
    /**
     * @return array<string, string|int>
     */
    public function createProduct(array $request): bool
    {
        $product = new Product();
        $product->fill($request);

        return $product->save();
    }

    /**
     * @return Collection<Product>
     */
    public function getProducts(): Collection
    {
        return Product::all();
    }
}
