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
        // Asegurar que siempre se establezca la fecha de creación
        if (!isset($data['fecha_creo'])) {
            $data['fecha_creo'] = now();
        }
        
        // El usuario_creo debe ser enviado por el controlador
        if (!isset($data['usuario_creo'])) {
            throw new \InvalidArgumentException('El campo usuario_creo es requerido para crear registros');
        }
        
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
            // Asegurar que siempre se actualice la fecha de modificación
            if (!isset($data['fecha_modifico'])) {
                $data['fecha_modifico'] = now();
            }
            
            // El usuario_modifico debe ser enviado por el controlador
            // Si no se especifica, lanzar una excepción para alertar al desarrollador
            if (!isset($data['usuario_modifico'])) {
                throw new \InvalidArgumentException('El campo usuario_modifico es requerido para actualizar registros');
            }
            
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
        // Preparar los datos de eliminación completos
        $datosEliminacion = [
            'eliminado' => true,
            'usuario_elimino' => $usuario_id,
            'motivo_elimino' => $motivo,
            'fecha_elimino' => now(),
            // También actualizar campos de modificación
            'usuario_modifico' => $usuario_id,
            'fecha_modifico' => now()
        ];

        // Usar el método update para mantener consistencia y validaciones
        return $this->update($id, $datosEliminacion);
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
        // Buscar incluso registros eliminados para poder restaurarlos
        $record = $this->model->where('id', $id)->first();
        
        if (!$record) {
            return false;
        }

        // Preparar los datos de restauración
        $datosRestauracion = [
            'eliminado' => false,
            'usuario_elimino' => null,
            'motivo_elimino' => null,
            'fecha_elimino' => null,
            // Actualizar campos de modificación
            'usuario_modifico' => $usuario_id,
            'fecha_modifico' => now()
        ];

        // Actualizar directamente sin usar el método update() ya que este busca solo registros no eliminados
        return $record->update($datosRestauracion);
    }
}
