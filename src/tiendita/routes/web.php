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
        // Formulario para crear un nuevo estado compra
        Route::get('estado_compras/create', [EstadoCompraController::class, 'create'])
            ->name('estado_compras.create');
        // Guardar un nuevo proveedor
        Route::post('estado_compras', [EstadoCompraController::class, 'store'])
            ->name('estado_compras.store');
        // Formulario para editar un estado compra existente
        Route::get('estado_compras/{id}/edit', [EstadoCompraController::class, 'edit'])
            ->name('estado_compras.edit');
        // Actualizar un estado compra existente
        Route::put('estado_compras/{id}', [EstadoCompraController::class, 'update'])
            ->name('estado_compras.update');




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
        //Formulario para crear un nuevo categoria
        Route::get('categorias/create', [CategoriasController::class, 'create'])
            ->name('categorias.create');
        // Guardar un nuevo 
        Route::post('categorias', [CategoriasController::class, 'store'])
            ->name('categorias.store');
            // Formulario para editar un categoria existent
        Route::get('categorias/{id}/edit', [CategoriasController::class, 'edit'])
            ->name('categorias.edit');
            // Actualizar un categoria existente
        Route::put('categorias/{id}', [CategoriasController::class, 'update'])
            ->name('categorias.update');
        




        //Listar todas las subcategorias
        Route::get('subcategorias', [SubcategoriasController::class, 'index'])
            ->name('subcategorias.index');
        //Formulario para crear un nuevo subcategoria
        Route::get('subcategorias/create', [SubcategoriasController::class, 'create'])
            ->name('subcategorias.create');
        // Guardar un nuevo subcategoria
        Route::post('subcategorias', [SubcategoriasController::class, 'store'])
            ->name('subcategorias.store');
            // Formulario para editar un subcategoria existent
        Route::get('subcategorias/{id}/edit', [SubcategoriasController::class, 'edit'])
            ->name('subcategorias.edit');
            // Actualizar un subcategoria existente
        Route::put('subcategorias/{id}', [SubcategoriasController::class, 'update'])
            ->name('subcategorias.update');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
