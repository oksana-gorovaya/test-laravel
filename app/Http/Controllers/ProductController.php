<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct(public ProductRepository $productRepository)
    {
    }

    public function index(): Collection
    {
        return $this->productRepository->getProducts();
    }

    public function store(StoreProductRequest $request): Response
    {
        $validatedData = $request->validated();
        $this->productRepository->createProduct($validatedData);

        return new Response('product created', 201);
    }
}
