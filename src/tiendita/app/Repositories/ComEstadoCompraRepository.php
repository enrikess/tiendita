<?php

namespace App\Repositories;

use App\Models\ComEstadoCompra;
use App\Repositories\Interfaces\BaseInterface;
use App\Repositories\Interfaces\ComEstadoCompraRepositoryInterface;


class ComEstadoCompraRepository extends BaseRepository implements ComEstadoCompraRepositoryInterface
{
    /**
     * Establece el modelo para este repositorio
     */
    protected function setModel()
    {
        $this->model = new ComEstadoCompra();
    }

    /**
     * Obtener estado compra paginados
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
