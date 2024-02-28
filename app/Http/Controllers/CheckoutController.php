<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScanRequest;
use App\Mappers\ScanRequestToCartItemMapper;
use App\Models\Request\CartItem;
use App\Services\Checkout;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CheckoutController extends Controller
{
    public function __construct(public Checkout $checkout, public ScanRequestToCartItemMapper $mapper)
    {
    }

    public function scan(ScanRequest $request): Response
    {
        $validatedData = $request->validated();
        $cartItm = $this->mapper->map($validatedData);
        $this->checkout->scan($cartItm);

        return new Response('total: ' . $this->checkout->getTotal(), 200);
    }
}
