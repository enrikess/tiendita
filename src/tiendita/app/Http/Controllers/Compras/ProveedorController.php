<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ProveedorServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    /**
     * @var ProveedorServiceInterface
     */
    protected $proveedorService;

    /**
     * Constructor
     *
     * @param ProveedorServiceInterface $proveedorService
     */
    public function __construct(ProveedorServiceInterface $proveedorService)
    {
        $this->proveedorService = $proveedorService;
    }

    /**
     * Mostrar todos los proveedores
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $proveedores = $this->proveedorService->todos();
        return view('compras.proveedores.index', compact('proveedores'));
    }

    /**
     * Mostrar formulario para crear un nuevo proveedor
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('compras.proveedores.create');
    }

    /**
     * Guardar un nuevo proveedor
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ruc' => 'required|string|max:11|unique:com_proveedores,ruc',
            'razon_social' => 'required|string|max:100',
            'nombre_comercial' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:200',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'persona_contacto' => 'nullable|string|max:100',
        ]);

        // Agregar usuario actual como creador
        $validated['usuario_creo'] = Auth::id();

        $proveedor = $this->proveedorService->crear($validated);

        return redirect()->route('proveedores.show', $proveedor)
            ->with('success', 'Proveedor creado correctamente');
    }

    /**
     * Mostrar un proveedor específico
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $proveedor = $this->proveedorService->obtenerPorId($id);

        if (!$proveedor) {
            return redirect()->route('proveedores.index')
                ->with('error', 'Proveedor no encontrado');
        }

        return view('compras.proveedores.show', compact('proveedor'));
    }

    /**
     * Mostrar formulario para editar un proveedor
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $proveedor = $this->proveedorService->obtenerPorId($id);

        if (!$proveedor) {
            return redirect()->route('proveedores.index')
                ->with('error', 'Proveedor no encontrado');
        }

        return view('compras.proveedores.edit', compact('proveedor'));
    }

    /**
     * Actualizar un proveedor existente
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ruc' => 'required|string|max:11|unique:com_proveedores,ruc,' . $id,
            'razon_social' => 'required|string|max:100',
            'nombre_comercial' => 'nullable|string|max:100',
            'direccion' => 'nullable|string|max:200',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'persona_contacto' => 'nullable|string|max:100',
        ]);

        // Agregar usuario actual como modificador
        $validated['usuario_modifico'] = Auth::id();

        $resultado = $this->proveedorService->actualizar($id, $validated);

        if ($resultado) {
            return redirect()->route('proveedores.show', $id)
                ->with('success', 'Proveedor actualizado correctamente');
        }

        return back()->withInput()
            ->with('error', 'No se pudo actualizar el proveedor');
    }

    /**
     * Eliminar un proveedor
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request)
    {
        $motivo = $request->input('motivo');
        $resultado = $this->proveedorService->eliminar($id, Auth::id(), $motivo);

        if ($resultado) {
            return redirect()->route('proveedores.index')
                ->with('success', 'Proveedor eliminado correctamente');
        }

        return back()->with('error', 'No se pudo eliminar el proveedor');
    }

    /**
     * Buscar proveedores
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $termino = $request->input('termino');
        $proveedores = $this->proveedorService->buscar($termino);

        return view('compras.proveedores.index', compact('proveedores', 'termino'));
    }
}
