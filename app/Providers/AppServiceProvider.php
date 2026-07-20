<?php

namespace App\Providers;

use App\Events\TransactionCreated;
use App\Listeners\ReduceStockListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Event::listen(
            TransactionCreated::class,
            ReduceStockListener::class
        );
    }
}