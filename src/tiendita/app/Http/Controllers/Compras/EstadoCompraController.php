<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ComEstadoCompraServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EstadoCompra\StoreEstadoCompraRequest;
use Inertia\Inertia;

class EstadoCompraController extends Controller
{
    /**
     * @var ComEstadoCompraServiceInterface
     */
    protected $comEstadoCompraService;

    /**
     * Constructor
     *
     * @param EstadoCompraServiceInterface $proveedorService
     */
    public function __construct(ComEstadoCompraServiceInterface $comEstadoCompraService)
    {
        $this->comEstadoCompraService = $comEstadoCompraService;
    }

    /**
     * Mostrar todos los estadoCompra
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Valor por defecto 10
        $page = $request->get('page', 1);         // Valor por defecto 1

        $estadoCompras = $this->comEstadoCompraService->paginados($perPage, $page);

        return Inertia::render('Compra/EstadoCompras/Index',
        [
            'estadoCompras' => $estadoCompras,
            'perPage' => $perPage,
            'page' => $page
        ]);
    }

    /**
     * Mostrar formulario para crear un nuevo estado compra
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Compra/EstadoCompras/Create');
    }

        /**
     * Guardar un nuevo estado compra
     *
     * @param \App\Http\Requests\EstadoCompras\StoreEstadoComprasRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEstadoCompraRequest $request)
    {

        $validated = $request->validated();

        $validated['usuario_creo'] = Auth::id();
        $validated['fecha_creo'] = now();

        $estadoCompras = $this->comEstadoCompraService->crear($validated);

        return redirect()->route('compras.estado_compras.index')
            ->with('success', 'Estado compras creado correctamente');
    }

    /**
     * Mostrar formulario para editar un estado compra
     *
     * @param int $id
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $estadoCompra = $this->comEstadoCompraService->obtenerPorId($id);


        if (!$estadoCompra) {
            return redirect()->route('compras.estado_compras.index')
                ->with('error', 'Estado compras no encontrado');
        }

        return Inertia::render('Compra/EstadoCompras/Edit', [
            'estadoCompra' => $estadoCompra
        ]);
    }

    /**
     * Actualizar un proveedor existente
     *
     * @param \App\Http\Requests\EstadoCompra\UpdateEstadoCompraRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEstadoCompraRequest $request, $id)
    {

        $validated = $request->validated();


        // Agregar usuario actual como modificador
        $validated['usuario_modifico'] = Auth::id();
        $validated['fecha_modifico'] = now();


        $resultado = $this->proveedorService->actualizar($id, $validated);

        if ($resultado) {
            return redirect()->route('compras.estado_compras.index')
                ->with('success', 'Estado Compra actualizado correctamente');
        }

        return back()->withInput()
            ->with('error', 'No se pudo actualizar el Estado Compra');
    }
}
