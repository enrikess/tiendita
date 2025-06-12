<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {        // Registrar repositorios
        $this->app->bind(
            \App\Repositories\Interfaces\RepositoryInterface::class,
            \App\Repositories\BaseRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\LogicalDeletionInterface::class,
            \App\Repositories\LogicalDeletionRepository::class
        );

        $this->app->bind(
            'ProveedorRepository',
            \App\Repositories\ProveedorRepository::class
        );

        // Registrar servicios
        $this->app->bind(
            \App\Services\Interfaces\ProveedorServiceInterface::class,
            \App\Services\ProveedorService::class
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
