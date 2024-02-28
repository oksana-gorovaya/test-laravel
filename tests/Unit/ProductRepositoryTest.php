<?php

namespace Tests\Unit;

use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateProduct(): void
    {
        // Given
        $repository = new ProductRepository();
        $request = [
            'name' => 'test product',
            'product_code' => 'PC1',
            'price' => 1,
        ];
        // When
        $isProductCreated = $repository->createProduct($request);

        //Then
        $this->assertTrue($isProductCreated);
    }

    public function testGetProducts(): void
    {
        // Given
        $repository = new ProductRepository();

        // When
        $products = $repository->getProducts();

        // Then
        $this->assertIsIterable($products);
    }
}
