<?php

namespace TestPax\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'TestPax\Repositories\UserRepository',
            'TestPax\Repositories\UserRepositoryEloquent'
        );

        $this->app->bind(
            'TestPax\Repositories\ProductRepository',
            'TestPax\Repositories\ProductRepositoryEloquent'
        );

        $this->app->bind(
            'TestPax\Repositories\CategoryRepository',
            'TestPax\Repositories\CategoryRepositoryEloquent'
        );
    }
}
