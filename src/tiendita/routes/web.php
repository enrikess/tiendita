<?php


use App\Http\Controllers\Compras\EstadoCompraController;
use App\Http\Controllers\Compras\ProveedorController;
use App\Http\Controllers\Inventario\CategoriasController;
use App\Http\Controllers\Inventario\SubcategoriasController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => 'pruebaVariableCanLogin',
        'canRegister' => 'pruebaVariableCanRegister',

    ]);
})->name('home');

Route::get('dashboard', function () {
    // Ejemplo de datos que puedes enviar a la vista
    $userData = auth()->user(); // Obtener el usuario autenticado

    return Inertia::render('Dashboard',[
        'canLogin' => 'pruebaVariableCanLogin',
        'canRegister' => 'pruebaVariableCanRegister',
        'timestamp' => now()->format('Y-m-d H:i:s'),
        'userData' => $userData,
        'statistics' => [
            'visits' => rand(100, 1000),
            'sales' => rand(10, 100),
            'revenue' => rand(1000, 10000),
        ]
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    // Grupo de rutas para el módulo de compras
    Route::prefix('compras')->name('compras.')->group(function () {

        // Listar todos los Estado compra
        Route::get('estado_compras', [EstadoCompraController::class, 'index'])
            ->name('estado_compras.index');



        // Listar todos los proveedores
        Route::get('proveedores', [ProveedorController::class, 'index'])
            ->name('proveedores.index');

        // Formulario para crear un nuevo proveedor
        Route::get('proveedores/create', [ProveedorController::class, 'create'])
            ->name('proveedores.create');

        // Guardar un nuevo proveedor
        Route::post('proveedores', [ProveedorController::class, 'store'])
            ->name('proveedores.store');

        // Buscar proveedores (¡IMPORTANTE! Esta ruta debe ir antes de {id})
        Route::get('proveedores/search', [ProveedorController::class, 'search'])
            ->name('proveedores.search');

        // Ver detalles de un proveedor específico
        Route::get('proveedores/{id}', [ProveedorController::class, 'show'])
            ->name('proveedores.show');

        // Formulario para editar un proveedor existente
        Route::get('proveedores/{id}/edit', [ProveedorController::class, 'edit'])
            ->name('proveedores.edit');

        // Actualizar un proveedor existente
        Route::put('proveedores/{id}', [ProveedorController::class, 'update'])
            ->name('proveedores.update');

        // Eliminado logico de proveedor
        Route::post('proveedores/{id}/dltlogico', [ProveedorController::class, 'dltlogico'])
            ->name('proveedores.dltlogico');

        // Eliminar un proveedor
        Route::delete('proveedores/{id}', [ProveedorController::class, 'destroy'])
            ->name('proveedores.destroy');
    });
});


Route::middleware(['auth', 'verified'])->group(function () {
    // Grupo de rutas para el módulo de compras
    Route::prefix('inventario')->name('inventario.')->group(function () {
        // Listar todas las categorias
        Route::get('categorias', [CategoriasController::class, 'index'])
            ->name('categorias.index');
        //Listar todas las subcategorias
        Route::get('subcategorias', [SubcategoriasController::class, 'index'])
            ->name('subcategorias.index');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
