<?php

namespace App\Repositories;

use App\Models\ComProveedor;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\Interfaces\LogicalDeletionInterface;

class ProveedorRepository extends LogicalDeletionRepository implements RepositoryInterface, LogicalDeletionInterface
{
    /**
     * Establece el modelo para este repositorio
     */
    protected function setModel()
    {
        $this->model = new ComProveedor();
    }

    /**
     * Buscar proveedores por RUC
     *
     * @param string $ruc
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function buscarPorRuc($ruc)
    {
        return $this->model->where('ruc', 'like', "%{$ruc}%")
            ->where('eliminado', false)
            ->get();
    }

    /**
     * Buscar proveedores por razón social
     *
     * @param string $razonSocial
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function buscarPorRazonSocial($razonSocial)
    {
        return $this->model->where('razon_social', 'like', "%{$razonSocial}%")
            ->where('eliminado', false)
            ->get();
    }    /**
     * Obtener proveedores activos
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActivos()
    {
        return $this->model->where('estado', true)
            ->where('eliminado', false)
            ->get();
    }    // El método eliminarLogico ahora se hereda de LogicalDeletionRepository
}
