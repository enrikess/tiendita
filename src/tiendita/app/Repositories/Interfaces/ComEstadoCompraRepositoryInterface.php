<?php

namespace App\Repositories\Interfaces;

interface ComEstadoCompraRepositoryInterface extends BaseInterface
{

    public function paginados($perPage, $page);
}
