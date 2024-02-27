<?php

namespace Tests\Unit;

use App\Http\Requests\StoreProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

//    public function testGetProducts(): void
//    {
//        // Given
//        $repository = new ProductRepository();
//
//        // When
//        $products = $repository->getProducts();
//
//        // Then
//        $this->assertIsIterable($products);
//    }

    public function testCreateProduct(): void
    {
        // Given
        $repository = new ProductRepository();
        $request = [
                'name' => 'test product',
                'description' => 'test product description',
                'price' => 1,
            ];
        // When
        $isProductCreated = $repository->createProduct($request);

        //Then
        $this->assertTrue($isProductCreated);
    }
}
