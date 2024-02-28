<?php

namespace Tests\Unit;

use App\Models\Request\CartItem;
use App\Repositories\PromoRepository;
use App\Services\Checkout;
use App\Services\PricingRules\BulkPurchase;
use App\Services\PricingRules\BuyOneGetOneFree;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function testBuyOneGetOneFreeWithOneProduct(): void
    {
        //Given
        $this->seed();

        $checkout = new Checkout([new BuyOneGetOneFree(new PromoRepository())]);
        $teaCartItem1 = new CartItem(3.11, 'FR1', 'Fruit tea');

        //When
        $checkout->scan($teaCartItem1);

        //Then
        $this->assertEquals(3.11, $checkout->getTotal());
    }

    public function testBuyOneGetOneFreeWithTwoProducts()
    {
        //Given
        $this->seed();

        $checkout = new Checkout([new BuyOneGetOneFree(new PromoRepository()), new BulkPurchase(new PromoRepository())]);
        $teaCartItem1 = new CartItem(3.11, 'FR1', 'Fruit tea');
        $teaCartItem2 = new CartItem(3.11, 'FR1', 'Fruit tea');

        //When
        $checkout->scan($teaCartItem1);
        $checkout->scan($teaCartItem2);

        //Then
        $this->assertEquals(3.11, $checkout->getTotal());
    }

    public function testBulkPurchaseWithOneProduct()
    {
        //Given
        $this->seed();

        $checkout = new Checkout([new BulkPurchase(new PromoRepository())]);
        $strawberryCartItem1 = new CartItem(5, 'SR1', 'Strawberries');

        //When
        $checkout->scan($strawberryCartItem1);

        //Then
        $this->assertEquals(5, $checkout->getTotal());
    }

    public function testBulkPurchaseWithThreeProducts()
    {
        //Given
        $this->seed();

        $checkout = new Checkout([new BulkPurchase(new PromoRepository())]);
        $strawberryCartItem1 = new CartItem(5, 'SR1', 'Strawberries');
        $strawberryCartItem2 = new CartItem(5, 'SR1', 'Strawberries');
        $strawberryCartItem3 = new CartItem(5, 'SR1', 'Strawberries');

        //When
        $checkout->scan($strawberryCartItem1);
        $checkout->scan($strawberryCartItem2);
        $checkout->scan($strawberryCartItem3);

        //Then
        $this->assertEquals(13.5, $checkout->getTotal());
    }

    public function testBulkPurchaseWithAdditionalProduct()
    {
        //Given
        $this->seed();

        $checkout = new Checkout([new BulkPurchase(new PromoRepository()), new BuyOneGetOneFree(new PromoRepository())]);
        $strawberryCartItem1 = new CartItem(5, 'SR1', 'Strawberries');
        $strawberryCartItem2 = new CartItem(5, 'SR1', 'Strawberries');
        $strawberryCartItem3 = new CartItem(5, 'SR1', 'Strawberries');
        $teaCartItem = new CartItem(3.11, 'FR1', 'Fruit tea');

        //When
        $checkout->scan($strawberryCartItem1);
        $checkout->scan($strawberryCartItem2);
        $checkout->scan($teaCartItem);
        $checkout->scan($strawberryCartItem3);

        //Then
        $this->assertEquals(16.61, $checkout->getTotal());
    }

    public function testBuyOneGetOneFreeWithAdditionalProducts()
    {
        //Given
        $this->seed();

        $checkout = new Checkout([new BulkPurchase(new PromoRepository()), new BuyOneGetOneFree(new PromoRepository())]);
        $teaCartItem1 = new CartItem(3.11, 'FR1', 'Fruit tea');
        $teaCartItem2 = new CartItem(3.11, 'FR1', 'Fruit tea');
        $teaCartItem3 = new CartItem(3.11, 'FR1', 'Fruit tea');
        $strawberryCartItem = new CartItem(5, 'SR1', 'Strawberries');
        $coffeeCartItem = new CartItem(11.23, 'CF1', 'Coffee');

        //When
        $checkout->scan($teaCartItem1);
        $checkout->scan($strawberryCartItem);
        $checkout->scan($teaCartItem2);
        $checkout->scan($teaCartItem3);
        $checkout->scan($coffeeCartItem);

        //Then
        $this->assertEquals(22.45, $checkout->getTotal());
    }
}
