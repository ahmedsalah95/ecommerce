<?php


namespace App\Providers;


use App\Repositories\AuthRepository;
use App\Repositories\Interfaces\AuthInterface;
use App\Repositories\Interfaces\ProductInterface;
use App\Repositories\ProductRepository;

use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(AuthInterface::class, AuthRepository::class);
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
