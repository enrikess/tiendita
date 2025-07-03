<?php

namespace App\Services\Interfaces;

use App\Models\comEstadoCompra;

/**
 * Interfaz para el servicio de proveedores
 */
interface ComEstadoCompraServiceInterface extends ServiceInterface
{
    /**
     * Obtener todos los estados compra
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function todos();


    public function paginados($perPage, $page);


}
