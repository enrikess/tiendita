<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registrar repositorios
        $this->app->bind(
            \App\Repositories\Interfaces\BaseInterface::class,
            \App\Repositories\BaseRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\ComEstadoCompraRepositoryInterface::class,
            \App\Repositories\ComEstadoCompraRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\ProveedorRepositoryInterface::class,
            \App\Repositories\ProveedorRepository::class
        );

        $this->app->bind(
            \App\Repositories\Interfaces\ProductoRepositoryInterface::class,
            \App\Repositories\ProductoRepository::class
        );

        // Registrar servicios

        $this->app->bind(
            \App\Services\Interfaces\ComEstadoCompraServiceInterface::class,
            \App\Services\ComEstadoCompraService::class
        );

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
