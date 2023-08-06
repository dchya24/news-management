<?php

namespace App\Providers;

use App\Repository\Auth\AuthRepository;
use App\Repository\Auth\AuthRepositoryInterface;
use App\Repository\News\NewsRepository;
use App\Repository\News\NewsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
