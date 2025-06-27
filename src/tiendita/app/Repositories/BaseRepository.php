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
    }

        /**
     * Eliminar lógicamente un registro
     *
     * @param int $id
     * @param int $usuario_id
     * @param string|null $motivo
     * @return bool
     */
    public function eliminarLogico($id, $usuario_id, $motivo = null)
    {
        $record = $this->find($id);
        if ($record) {
            // Marcar como eliminado
            $record->eliminado = true;

            // Registrar quién eliminó y por qué
            $record->usuario_elimino = $usuario_id;
            $record->motivo_elimino = $motivo;

            // Establecer la fecha de eliminación manualmente
            $record->fecha_elimino = now();

            // También actualizar fecha de modificación y usuario que modificó
            $record->fecha_modifico = now();
            $record->usuario_modifico = $usuario_id;

            return $record->save();
        }
        return false;
    }

    /**
     * Restaurar un registro eliminado lógicamente
     *
     * @param int $id
     * @param int $usuario_id
     * @return bool
     */
    public function restaurar($id, $usuario_id)
    {
        // Usamos where directamente para buscar incluso registros eliminados
        $record = $this->model->where('id', $id)->first();

        if ($record) {
            // Desmarcar como eliminado
            $record->eliminado = false;

            // Actualizar información de modificación
            $record->usuario_modifico = $usuario_id;
            $record->fecha_modifico = now();

            // Limpiar datos de eliminación
            $record->usuario_elimino = null;
            $record->motivo_elimino = null;
            $record->fecha_elimino = null;

            return $record->save();
        }
        return false;
    }
}
