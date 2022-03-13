<?php

namespace App\Providers;

use App\Interfaces\AuthorInterface;
use App\Interfaces\BookInterface;
use App\Interfaces\ContactInterface;
use App\Service\AuthorService;
use App\Service\BookService;
use App\Service\ContactService;
use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(AuthorInterface::class,AuthorService::class);
        app()->bind(BookInterface::class,BookService::class);
        app()->bind(ContactInterface::class,ContactService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
