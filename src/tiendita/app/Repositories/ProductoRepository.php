<?php

namespace App\Repositories;

use App\Models\InvProducto;
use App\Repositories\Interfaces\BaseInterface;
use App\Repositories\Interfaces\ProductoRepositoryInterface;


class ProveedorRepository extends BaseRepository implements ProductoRepositoryInterface
{
    /**
     * Establece el modelo para este repositorio
     */
    protected function setModel()
    {
        $this->model = new InvProducto();
    }

    public function BuscarCodigoBarra($codigoBarra) {
        return $this->model->where('codigo_barra', 'like', "%{$codigoBarra}%")
            ->where('eliminado', false)
            ->get();
    }

}
