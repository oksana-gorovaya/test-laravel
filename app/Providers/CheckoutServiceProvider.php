<?php

namespace App\Providers;

use App\Repositories\PromoRepository;
use App\Services\Checkout;
use App\Services\PricingRules\BulkPurchase;
use App\Services\PricingRules\BuyOneGetOneFree;
use Illuminate\Support\ServiceProvider;

class CheckoutServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(Checkout::class, function ($app) {
            return new Checkout([
                new BuyOneGetOneFree($app->make(PromoRepository::class)),
                new BulkPurchase($app->make(PromoRepository::class)),
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
