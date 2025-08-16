<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MenuPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // ====== Roles ======
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $vendedor = Role::firstOrCreate(['name' => 'vendedor']);

        // ====== Dashboard ======
        $dashboard = Menu::create([
            'nombre' => 'Dashboard',
            'ruta' => 'dashboard',
            'icono' => 'LayoutGrid',
            'permiso' => null,
            'parent_id' => null,
            'orden' => 1
        ]);

        // ====== Inventario ======
        $inventario = Menu::create([
            'nombre' => 'Inventario',
            'ruta' => null,
            'icono' => 'LayoutGrid',
            'permiso' => null,
            'parent_id' => null,
            'orden' => 2
        ]);

        // Categorías
        Permission::firstOrCreate(['name' => 'inventario.categorias.ver']);
        Permission::firstOrCreate(['name' => 'inventario.categorias.crear']);
        Permission::firstOrCreate(['name' => 'inventario.categorias.editar']);
        Permission::firstOrCreate(['name' => 'inventario.categorias.eliminar']);

        Menu::create([
            'nombre' => 'Categorias',
            'ruta' => 'inventario.categorias.index',
            'icono' => 'LayoutGrid',
            'permiso' => 'inventario.categorias.ver',
            'parent_id' => $inventario->id,
            'orden' => 1
        ]);

        // Subcategorías
        Permission::firstOrCreate(['name' => 'inventario.subcategorias.ver']);
        Permission::firstOrCreate(['name' => 'inventario.subcategorias.crear']);
        Permission::firstOrCreate(['name' => 'inventario.subcategorias.editar']);
        Permission::firstOrCreate(['name' => 'inventario.subcategorias.eliminar']);

        Menu::create([
            'nombre' => 'Subcategorias',
            'ruta' => 'inventario.subcategorias.index',
            'icono' => 'ChartColumnStacked',
            'permiso' => 'inventario.subcategorias.ver',
            'parent_id' => $inventario->id,
            'orden' => 2
        ]);

        // ====== Compras ======
        $compras = Menu::create([
            'nombre' => 'Compras',
            'ruta' => null,
            'icono' => 'LayoutGrid',
            'permiso' => null,
            'parent_id' => null,
            'orden' => 3
        ]);

        // Estado Compra
        Permission::firstOrCreate(['name' => 'compras.estado.ver']);
        Permission::firstOrCreate(['name' => 'compras.estado.crear']);
        Permission::firstOrCreate(['name' => 'compras.estado.editar']);
        Permission::firstOrCreate(['name' => 'compras.estado.eliminar']);

        Menu::create([
            'nombre' => 'Estado Compra',
            'ruta' => 'compras.estado.index',
            'icono' => 'LayoutGrid',
            'permiso' => 'compras.estado.ver',
            'parent_id' => $compras->id,
            'orden' => 1
        ]);

        // Proveedores
        Permission::firstOrCreate(['name' => 'compras.proveedores.ver']);
        Permission::firstOrCreate(['name' => 'compras.proveedores.crear']);
        Permission::firstOrCreate(['name' => 'compras.proveedores.editar']);
        Permission::firstOrCreate(['name' => 'compras.proveedores.eliminar']);

        Menu::create([
            'nombre' => 'Proveedores',
            'ruta' => 'compras.proveedores.index',
            'icono' => 'LayoutGrid',
            'permiso' => 'compras.proveedores.ver',
            'parent_id' => $compras->id,
            'orden' => 2
        ]);

        // Órdenes de Compra
        Permission::firstOrCreate(['name' => 'compras.ordenes.ver']);
        Permission::firstOrCreate(['name' => 'compras.ordenes.crear']);
        Permission::firstOrCreate(['name' => 'compras.ordenes.editar']);
        Permission::firstOrCreate(['name' => 'compras.ordenes.eliminar']);

        Menu::create([
            'nombre' => 'Órdenes de Compra',
            'ruta' => 'compras.ordenes.index',
            'icono' => 'LayoutGrid',
            'permiso' => 'compras.ordenes.ver',
            'parent_id' => $compras->id,
            'orden' => 3
        ]);

        // ====== Asignar permisos ======
        $admin->givePermissionTo(Permission::all());

        $vendedor->givePermissionTo([
            'inventario.categorias.ver',
            'inventario.subcategorias.ver',
            'compras.estado.ver',
            'compras.proveedores.ver',
            'compras.ordenes.ver'
        ]);
    }
}
