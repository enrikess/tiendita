<?php

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

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
