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

    /**
     * Crear un nuevo Estado Compra
     *
     * @param array $datos
     * @return ComEstadoCompra
     */
    public function crear(array $datos);



    public function paginados($perPage, $page);


}
