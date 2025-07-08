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
use App\Http\Requests\Proveedores\SearchProveedorRequest;

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

        $perPage = $request->get('per_page', 10); // Valor por defecto 10
        $page = $request->get('page', 1);         // Valor por defecto 1

        $proveedores = $this->proveedorService->paginados($perPage, $page);

        return Inertia::render('Proveedores/Index', [
            'proveedores' => $proveedores,
            'perPage' => $perPage,
            'page' => $page
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
    public function store(StoreProveedorRequest $request)
    {
        $validated = $request->validated();
        $validated['usuario_creo'] = Auth::id();

        $proveedor = $this->proveedorService->crear($validated);

        return redirect()->route('compras.proveedores.index', $proveedor)
            ->with('success', 'Proveedor creado correctamente');
    }

    /**
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
    public function update(UpdateProveedorRequest $request, $id)
    {
        $validated = $request->validated();


        // Agregar usuario actual como modificador
        $validated['usuario_modifico'] = Auth::id();

        $resultado = $this->proveedorService->actualizar($id, $validated);

        if ($resultado) {
            session()->flash('success', 'Usuario creado exitosamente.');
            return redirect()->route('compras.proveedores.index')
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
    public function destroy($id, DeleteProveedorRequest $request)
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
     * Eliminado logico un proveedor
     *
     * @param int $id
     * @param \App\Http\Requests\Proveedores\DeleteProveedorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dltlogico($id, Request $request)
    {
        $usuario_id = auth()->id();
        $resultado = $this->proveedorService->eliminadoLogico($id, $usuario_id);

        // Obtén la página actual de la request
        $pagina = $request->get('page', 1);

        if ($resultado) {
            return redirect()->route('compras.proveedores.index', ['page' => $pagina])
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
        $resultados = $this->proveedorService->buscar($ruc);

        return Inertia::render('Proveedores/Index', [
            'proveedores' => $resultados,
            'filters' => [
                'search' => $ruc
            ]
        ]);
    }
}
