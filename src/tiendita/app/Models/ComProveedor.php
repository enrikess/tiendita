<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComProveedor extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * Nombre de la tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'com_proveedores';

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
}
