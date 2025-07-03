<?php

namespace App\Services;

use App\Repositories\ComEstadoCompraRepository;
use App\Services\Interfaces\ComEstadoCompraServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ComEstadoCompraService implements ComEstadoCompraServiceInterface
{
    /**
     * @var ComEstadoCompraRepository
     */
    protected $comEstadoCompraRepository;

    /**
     * Constructor
     *
     * @param ComEstadoCompraRepository $proveedorRepository
     */
    public function __construct(ComEstadoCompraRepository $comEstadoCompraRepository)
    {
        $this->comEstadoCompraRepository = $comEstadoCompraRepository;
    }

    /**
     * Obtener todos los comEstadoCompra
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function todos()
    {
        return $this->comEstadoCompraRepository->all();
    }

    /**
     * Obtener todos los comEstadoCompra
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function paginados($perPage = 5, $page = 1)
    {
        return $this->comEstadoCompraRepository->paginados($perPage, $page);
    }
}
