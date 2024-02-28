<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScanRequest;
use App\Mappers\ScanRequestToCartItemMapper;
use App\Services\Checkout;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CheckoutController extends Controller
{
    public function __construct(public Checkout $checkout, public ScanRequestToCartItemMapper $mapper)
    {
    }

    /**
     * Specification:
     * - Calculates total price based on active pricing rules.
     *
     * @api
     */
    public function scan(ScanRequest $request): Response
    {
        $validatedData = $request->validated();
        $cartItem = $this->mapper->map($validatedData);
        $this->checkout->scan($cartItem);

        return new Response('total: ' . $this->checkout->getTotal(), 200);
    }
}
