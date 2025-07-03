<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ComEstadoCompraServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
