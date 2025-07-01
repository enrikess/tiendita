<?php

namespace App\Services\Interfaces;

use App\Models\ComProveedor;

/**
 * Interfaz para el servicio de proveedores
 */
interface ProveedorServiceInterface extends ServiceInterface
{
    /**
     * Obtener todos los proveedores
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function todos();

    /**
     * Obtener un proveedor por su ID
     *
     * @param int $id
     * @return ComProveedor|null
     */
    public function obtenerPorId($id);

    /**
     * Crear un nuevo proveedor
     *
     * @param array $datos
     * @return ComProveedor
     */
    public function crear(array $datos);

    /**
     * Actualizar un proveedor existente
     *
     * @param int $id
     * @param array $datos
     * @return bool
     */
    public function actualizar($id, array $datos);

    /**
     * Eliminar lógicamente un proveedor
     *
     * @param int $id
     * @param int $usuario_id
     * @param string|null $motivo
     * @return bool
     */
    public function eliminar($id, $usuario_id, $motivo = null);



    public function eliminadoLogico($id, $usuario_id);
    /**
     * Buscar proveedores por RUC o razón social
     *
     * @param string $ruc
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function buscar($ruc);


    public function paginados($perPage, $page);
}
