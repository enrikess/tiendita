<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComProveedor extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'com_proveedores';

    /**
     * Renombrar los timestamps estándar de Laravel para usar nuestros campos personalizados
     */
    const CREATED_AT = 'fecha_creo';
    const UPDATED_AT = 'fecha_modifico';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ruc',
        'razon_social',
        'nombre_comercial',
        'direccion',
        'telefono',
        'email',
        'persona_contacto',
        'estado',
        'usuario_creo',
        'fecha_creo',
        'usuario_modifico',
        'fecha_modifico',
        'eliminado',
        'usuario_elimino',
        'motivo_elimino',
        'fecha_elimino'
    ];

    /**
     * Relación con el usuario que creó el registro
     */
    public function usuarioCreo()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_creo');
    }

    /**
     * Relación con el usuario que modificó el registro
     */
    public function usuarioModifico()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_modifico');
    }

    /**
     * Relación con el usuario que eliminó el registro
     */
    public function usuarioElimino()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_elimino');
    }

    /**
     * Realiza una eliminación lógica del registro
     *
     * @param int $usuario_id ID del usuario que realiza la eliminación
     * @param string|null $motivo Motivo de la eliminación
     * @return bool
     */
    public function eliminarLogico($usuario_id, $motivo = null)
    {
        $this->eliminado = true;
        $this->usuario_elimino = $usuario_id;
        $this->motivo_elimino = $motivo;
        $this->fecha_elimino = now();
        return $this->save();
    }
}
