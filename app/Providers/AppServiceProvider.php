<?php

namespace App\Providers;

use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ProductInvoiceRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductInvoiceRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );
        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->singleton(
            ProductInvoiceRepositoryInterface::class,
            ProductInvoiceRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
