<?php

namespace App\Services;

use App\Repositories\ComEstadoCompraRepository;
use App\Services\Interfaces\ComEstadoCompraServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ComEstadoCompraService implements ComEstadoCompraServiceInterface
{
    /**
     * @var ComEstadoCompraRepository
     */
    protected $comEstadoCompraRepository;

    /**
     * Constructor
     *
     * @param ComEstadoCompraRepository $proveedorRepository
     */
    public function __construct(ComEstadoCompraRepository $comEstadoCompraRepository)
    {
        $this->comEstadoCompraRepository = $comEstadoCompraRepository;
    }

    /**
     * Obtener todos los comEstadoCompra
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function todos()
    {
        return $this->comEstadoCompraRepository->all();
    }

    /**
     * Obtener un estado compra por su ID
     *
     * @param int $id
     * @return \App\Models\ComEstadoCompra|null
     */
    public function obtenerPorId($id)
    {
        return $this->comEstadoCompraRepository->find($id);
    }

    /**
     * Crear un nuevo estado compra
     *
     * @param array $datos
     * @return \App\Models\ComEstadoCompra
     */
    public function crear(array $datos)
    {
        // Podemos añadir validaciones o lógica de negocio adicional aquí
        try {
            DB::beginTransaction();

            // Asegurarse de que ciertos campos estén presentes
            $datos['estado'] = $datos['estado'] ?? true;

            // Crear el proveedor
            $estadoCompra = $this->comEstadoCompraRepository->create($datos);

            // Si hay operaciones adicionales que realizar, se hacen aquí

            DB::commit();
            return $estadoCompra;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear Estado Compra: ' . $e->getMessage());
            throw $e;
        }
    }

        /**
     * Actualizar un estado compra existente
     *
     * @param int $id
     * @param array $datos
     * @return bool
     */
    public function actualizar($id, array $datos)
    {
        try {
            DB::beginTransaction();

            $resultado = $this->comEstadoCompraRepository->update($id, $datos);

            DB::commit();
            return $resultado;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar estado compra: ' . $e->getMessage());
            throw $e;
        }
    }


    /**
     * Obtener todos los comEstadoCompra
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function paginados($perPage = 5, $page = 1)
    {
        return $this->comEstadoCompraRepository->paginados($perPage, $page);
    }
}
