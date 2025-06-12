<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Método que debe implementarse en las clases hijas para definir el modelo
     */
    abstract protected function setModel();

    /**
     * Obtener todos los registros
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->where('eliminado', false)->get();
    }

    /**
     * Buscar un registro por ID
     *
     * @param int $id
     * @return Model|null
     */
    public function find($id)
    {
        return $this->model->where('eliminado', false)->find($id);
    }

    /**
     * Crear un nuevo registro
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Actualizar un registro existente
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data)
    {
        $record = $this->find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    /**
     * Eliminar físicamente un registro
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $record = $this->find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }    // Los métodos de borrado lógico se han movido a LogicalDeletionRepository
}
