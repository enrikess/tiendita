<?php

namespace App\Repositories\Interfaces;

interface LogicalDeletionInterface
{
    /**
     * Eliminar lógicamente un registro
     *
     * @param int $id
     * @param int $usuario_id
     * @param string|null $motivo
     * @return bool
     */
    public function eliminarLogico($id, $usuario_id, $motivo = null);

    /**
     * Restaurar un registro eliminado lógicamente
     *
     * @param int $id
     * @param int $usuario_id
     * @return bool
     */
    public function restaurar($id, $usuario_id);
}
