<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Models\Review;
use App\Observers\ReviewObserver;
use \App\Models\Product;
use App\Observers\ProductObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Observers
        Product::observe(ProductObserver::class);
        Review::observe(ReviewObserver::class);
    }
}
