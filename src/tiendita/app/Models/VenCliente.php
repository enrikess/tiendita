<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenCliente extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'ven_clientes';


    public $timestamps = false;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'tipo_documento_id',
        'numero_documento',
        'correo',
        'telefono',
        'razon_social',
        'direccion',
        'estado',
        'usuario_creo',
        'fecha_creo',
        'usuario_modifico',
        'fecha_modifico',
        'eliminado',
        'usuario_elimino',
        'motivo_elimino',
        'fecha_elimino',
    ];


    protected $casts = [
        'estado' => 'boolean',
        'eliminado' => 'boolean',
        'fecha_creo' => 'datetime',
        'fecha_modifico' => 'datetime',
        'fecha_elimino' => 'datetime',
    ];


    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }
    /**
     * Relación con el tipo de documento
     */
    public function tipoDocumento()
    {
        return $this->belongsTo(SisTipoDocumento::class, 'tipo_documento_id');
    }

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
        return $this->belongsTo(Usuario::class, 'usuario_modifico');
    }

    /**
     * Relación con el usuario que eliminó el registro
     */
    public function usuarioElimino()
    {
        return $this->belongsTo(Usuario::class, 'usuario_elimino');
    }
}
