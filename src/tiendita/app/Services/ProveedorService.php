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
            
            // Asegurarse de que se registren las fechas y usuarios
            if (!isset($datos['fecha_creo'])) {
                $datos['fecha_creo'] = now();
            }
            
            // Si el usuario no está especificado, usar el usuario autenticado
            if (!isset($datos['usuario_creo']) && auth()->check()) {
                $datos['usuario_creo'] = auth()->id();
            }

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
            
            // Asegurarse de que se registren la fecha y usuario de modificación
            $datos['fecha_modifico'] = now();
            
            // Si el usuario no está especificado, usar el usuario autenticado
            if (!isset($datos['usuario_modifico']) && auth()->check()) {
                $datos['usuario_modifico'] = auth()->id();
            }

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
        try {
            DB::beginTransaction();
            
            // Verificar si se proporcionó el ID de usuario
            if (!$usuario_id && auth()->check()) {
                $usuario_id = auth()->id();
            }
            
            // Verificar si necesitamos añadir un motivo predeterminado
            if (empty($motivo)) {
                $motivo = 'Eliminación desde sistema';
            }

            $resultado = $this->proveedorRepository->eliminarLogico($id, $usuario_id, $motivo);

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
     * @param string $termino
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function buscar($termino)
    {
        // Si el término parece un RUC (solo números y de cierta longitud)
        if (is_numeric($termino) && strlen($termino) >= 8 && strlen($termino) <= 11) {
            return $this->proveedorRepository->buscarPorRuc($termino);
        }

        // Si no, buscar por razón social
        return $this->proveedorRepository->buscarPorRazonSocial($termino);
    }
}
