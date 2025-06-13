<?php

namespace App\Repositories;

use App\Model\ComProveedor;    // Se eliminó el método buscarPorRazonSocialPaginado para simplificaredor;
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

    // Se eliminó el método buscarPorRucPaginado para simplificar

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
    }

    // Se eliminó el método buscarPorRazonSocialPaginado para simplificar

    /**
     * Obtener proveedores activos
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActivos()
    {
        return $this->model->where('estado', true)
            ->where('eliminado', false)
            ->get();
    }

}
