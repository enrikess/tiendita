<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ComEstadoCompra extends Model
{
    use HasFactory;

    protected $table = 'com_estado_compras';

    public $timestamps = false;


    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
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

    protected $casts = [
        'estado' => 'boolean',
        'eliminado' => 'boolean',
        'usuario_creo' => 'integer',
        'fecha_creo' => 'datetime',
        'usuario_modifico' => 'integer',
        'fecha_modifico' => 'datetime',
        'usuario_elimino' => 'integer',
        'fecha_elimino' => 'datetime',
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
