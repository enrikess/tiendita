<?php

namespace App\Services;

use App\Repositories\ProveedorRepository;
use App\Services\Interfaces\ProveedorServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProveedorService implements ProveedorServiceInterface
{
    /**
     * @var ProveedorRepository
     */
    protected $proveedorRepository;

    /**
     * Constructor
     *
     * @param ProveedorRepository $proveedorRepository
     */
    public function __construct(ProveedorRepository $proveedorRepository)
    {
        $this->proveedorRepository = $proveedorRepository;
    }

    /**
     * Obtener todos los proveedores
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function todos()
    {
        return $this->proveedorRepository->all();
    }

    /**
     * Obtener un proveedor por su ID
     *
     * @param int $id
     * @return \App\Models\ComProveedor|null
     */
    public function obtenerPorId($id)
    {
        return $this->proveedorRepository->find($id);
    }

    /**
     * Crear un nuevo proveedor
     *
     * @param array $datos
     * @return \App\Models\ComProveedor
     */
    public function crear(array $datos)
    {
        // Podemos añadir validaciones o lógica de negocio adicional aquí
        try {
            DB::beginTransaction();

            // Asegurarse de que ciertos campos estén presentes
            $datos['estado'] = $datos['estado'] ?? true;

            // Crear el proveedor
            $proveedor = $this->proveedorRepository->create($datos);

            // Si hay operaciones adicionales que realizar, se hacen aquí

            DB::commit();
            return $proveedor;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear proveedor: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Actualizar un proveedor existente
     *
     * @param int $id
     * @param array $datos
     * @return bool
     */
    public function actualizar($id, array $datos)
    {
        try {
            DB::beginTransaction();

            $resultado = $this->proveedorRepository->update($id, $datos);

            DB::commit();
            return $resultado;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al actualizar proveedor: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Eliminar lógicamente un proveedor
     *
     * @param int $id
     * @param int $usuario_id
     * @param string|null $motivo
     * @return bool
     */
    public function eliminar($id, $usuario_id, $motivo = null)
    {

    }

        /**
     * Eliminar lógicamente un proveedor
     *
     * @param int $id
     * @param int $usuario_id
     * @param string|null $motivo
     * @return bool
     */
    public function eliminadoLogico($id, $usuario_id)
    {
        try {
            DB::beginTransaction();

            $resultado = $this->proveedorRepository->eliminarLogico($id, $usuario_id);

            DB::commit();
            return $resultado;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al eliminar proveedor: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Buscar proveedores por RUC o razón social
     *
     * @param string $ruc
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function buscar($ruc)
    {
        // Si el término parece un RUC (solo números y de cierta longitud)
        if (is_numeric($ruc) && strlen($ruc) >= 8 && strlen($ruc) <= 11) {
            // Búsqueda estándar
            return $this->proveedorRepository->buscarPorRuc($ruc);
        }

        // Si no, buscar por razón social
        return $this->proveedorRepository->buscarPorRazonSocial($ruc);
    }

        /**
     * Obtener todos los proveedores
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function paginados($perPage = 5, $page = 1)
    {
        return $this->proveedorRepository->paginados($perPage, $page);
    }


}
