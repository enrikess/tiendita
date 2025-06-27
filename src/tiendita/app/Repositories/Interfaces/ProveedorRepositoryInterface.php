<?php

namespace App\Repositories\Interfaces;

interface ProveedorRepositoryInterface extends BaseInterface
{

    public function buscarPorRuc($ruc);
    public function buscarPorRazonSocial($razonSocial);
    public function getActivos();
}
