<?php

namespace App\Repositories;

use App\Models\ComProveedor;
use App\Repositories\Interfaces\BaseInterface;
use App\Repositories\Interfaces\ProveedorRepositoryInterface;


class ProveedorRepository extends BaseRepository implements ProveedorRepositoryInterface
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

    /**
     * Obtener proveedores paginados
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginados($perPage, $page)
    {
        return $this->model->where('eliminado', false)
            ->orderBy('id', 'asc')
            ->paginate($perPage, ['*'], 'page', $page);
    }

}
