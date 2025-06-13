<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Http\Requests\Proveedores\DeleteProveedorRequest;
use App\Http\Requests\Proveedores\StoreProveedorRequest;
use App\Http\Requests\Proveedores\UpdateProveedorRequest;
use App\Services\Interfaces\ProveedorServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $proveedores = $this->proveedorService->todos();

        // Convertimos la colección a paginación
        $proveedoresPaginados = new \Illuminate\Pagination\LengthAwarePaginator(
            $proveedores->forPage($request->input('page', 1), $perPage),
            $proveedores->count(),
            $perPage,
            $request->input('page', 1),
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return Inertia::render('Proveedores/Index', [
            'proveedores' => $proveedoresPaginados,
            'filters' => $request->only(['search', 'per_page'])
        ]);
    }

    /**
     * Mostrar formulario para crear un nuevo proveedor
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Proveedores/Create');
    }

    /**
     * Guardar un nuevo proveedor
     *
     * @param \App\Http\Requests\Proveedores\StoreProveedorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\App\Http\Requests\Proveedores\StoreProveedorRequest $request)
    {
        $validated = $request->validated();

        // Agregar usuario actual como creador
        $validated['usuario_creo'] = Auth::id();

        $proveedor = $this->proveedorService->crear($validated);

        return redirect()->route('proveedores.show', $proveedor)
            ->with('success', 'Proveedor creado correctamente');
    }    /**
     * Mostrar un proveedor específico
     *
     * @param int $id
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $proveedor = $this->proveedorService->obtenerPorId($id);

        if (!$proveedor) {
            return redirect()->route('proveedores.index')
                ->with('error', 'Proveedor no encontrado');
        }

        return Inertia::render('Proveedores/Show', [
            'proveedor' => $proveedor
        ]);
    }    /**
     * Mostrar formulario para editar un proveedor
     *
     * @param int $id
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $proveedor = $this->proveedorService->obtenerPorId($id);

        if (!$proveedor) {
            return redirect()->route('proveedores.index')
                ->with('error', 'Proveedor no encontrado');
        }

        return Inertia::render('Proveedores/Edit', [
            'proveedor' => $proveedor
        ]);
    }

    /**
     * Actualizar un proveedor existente
     *
     * @param \App\Http\Requests\Proveedores\UpdateProveedorRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(\App\Http\Requests\Proveedores\UpdateProveedorRequest $request, $id)
    {
        $validated = $request->validated();

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
     * @param \App\Http\Requests\Proveedores\DeleteProveedorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, \App\Http\Requests\Proveedores\DeleteProveedorRequest $request)
    {
        $validated = $request->validated();
        $motivo = $validated['motivo'];
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
     * @return \Inertia\Response
     */
    public function search(Request $request)
    {
        $ruc = $request->input('termino');
        $perPage = $request->input('per_page', 10);

        // Obtenemos los proveedores (colección)
        $resultados = $this->proveedorService->buscar($ruc);

        // Convertimos la colección a paginación
        $proveedores = new \Illuminate\Pagination\LengthAwarePaginator(
            $resultados->forPage($request->input('page', 1), $perPage),
            $resultados->count(),
            $perPage,
            $request->input('page', 1),
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return Inertia::render('Proveedores/Index', [
            'proveedores' => $proveedores,
            'filters' => [
                'search' => $ruc,
                'per_page' => $perPage
            ]
        ]);
    }
}
