<?php

namespace App\Http\Controllers\Inventario;

use App\Enums\TipoUbicacion;
use App\Http\Controllers\Controller;
use App\Models\InvUbicacione;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class UbicacionController extends Controller
{
    /**
     * Mostrar todas las ubicaciones
     */
    public function index()
    {
        $ubicaciones = InvUbicacione::all();
        return view('inventario.ubicaciones.index', compact('ubicaciones'));
    }

    /**
     * Mostrar formulario para crear una nueva ubicación
     */
    public function create()
    {
        $tipos = TipoUbicacion::options();
        return view('inventario.ubicaciones.create', compact('tipos'));
    }

    /**
     * Guardar una nueva ubicación
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
            'tipo' => ['required', new Enum(TipoUbicacion::class)],
            'categoria_id' => 'required|exists:inv_categorias,id',
            'descripcion' => 'nullable|string|max:100',
        ]);

        $ubicacion = InvUbicacione::create($validated);

        return redirect()->route('ubicaciones.show', $ubicacion)
            ->with('success', 'Ubicación creada correctamente');
    }

    /**
     * Mostrar una ubicación específica
     */
    public function show(InvUbicacione $ubicacion)
    {
        // Ejemplo de cómo comparar con un ENUM
        $esBodega = $ubicacion->tipo === TipoUbicacion::BODEGA;

        return view('inventario.ubicaciones.show', compact('ubicacion', 'esBodega'));
    }

    /**
     * Mostrar formulario para editar una ubicación
     */
    public function edit(InvUbicacione $ubicacion)
    {
        $tipos = TipoUbicacion::options();
        return view('inventario.ubicaciones.edit', compact('ubicacion', 'tipos'));
    }

    /**
     * Actualizar una ubicación específica
     */
    public function update(Request $request, InvUbicacione $ubicacion)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
            'tipo' => ['required', new Enum(TipoUbicacion::class)],
            'categoria_id' => 'required|exists:inv_categorias,id',
            'descripcion' => 'nullable|string|max:100',
        ]);

        $ubicacion->update($validated);

        return redirect()->route('ubicaciones.show', $ubicacion)
            ->with('success', 'Ubicación actualizada correctamente');
    }

    /**
     * Eliminar una ubicación
     */
    public function destroy(InvUbicacione $ubicacion)
    {
        $ubicacion->delete();

        return redirect()->route('ubicaciones.index')
            ->with('success', 'Ubicación eliminada correctamente');
    }
}
