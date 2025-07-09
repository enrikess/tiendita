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
     * Obtener un estados compra por su ID
     *
     * @param int $id
     * @return ComEstadoCompra|null
     */
    public function obtenerPorId($id);

    /**
     * Crear un nuevo Estado Compra
     *
     * @param array $datos
     * @return ComEstadoCompra
     */
    public function crear(array $datos);

    /**
     * Actualizar un Estado Compra existente
     *
     * @param int $id
     * @param array $datos
     * @return bool
     */
    public function actualizar($id, array $datos);


    public function paginados($perPage, $page);


}
