<?php

namespace App\Repositories;

use App\Repositories\Interfaces\LogicalDeletionInterface;
use Illuminate\Support\Facades\Auth;

abstract class LogicalDeletionRepository extends BaseRepository implements LogicalDeletionInterface
{
    /**
     * Crear un nuevo registro con control manual de timestamps
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        // Control manual de la fecha de creación
        if (!isset($data['fecha_creo'])) {
            $data['fecha_creo'] = now();
        }

        // Control manual del usuario que crea
        if (!isset($data['usuario_creo']) && Auth::check()) {
            $data['usuario_creo'] = Auth::id();
        }

        return parent::create($data);
    }

    /**
     * Actualizar un registro existente con control manual de timestamps
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data)
    {
        // Control manual de la fecha de modificación
        if (!isset($data['fecha_modifico'])) {
            $data['fecha_modifico'] = now();
        }

        // Control manual del usuario que modifica
        if (!isset($data['usuario_modifico']) && Auth::check()) {
            $data['usuario_modifico'] = Auth::id();
        }

        return parent::update($id, $data);
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
