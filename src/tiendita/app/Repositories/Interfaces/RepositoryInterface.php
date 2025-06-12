<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    /**
     * Obtener todos los registros
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Buscar un registro por ID
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($id);

    /**
     * Crear un nuevo registro
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

    /**
     * Actualizar un registro existente
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data);    /**
     * Eliminar físicamente un registro
     *
     * @param int $id
     * @return bool
     */
    public function delete($id);
}
