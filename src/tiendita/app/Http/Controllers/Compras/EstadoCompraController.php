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

        $estadoCompras = $this->comEstadoCompraService->crear($validated);

        return redirect()->route('compras.estado_compras.index')
            ->with('success', 'Estado compras creado correctamente');
    }
}
