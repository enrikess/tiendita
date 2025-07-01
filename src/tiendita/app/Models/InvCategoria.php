<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvCategoria extends Model
{
    use HasFactory;
    //
    protected $table = 'inv_categorias';

    public $timestamps = false;

    protected $fillable = [
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
        'fecha_creo' => 'datetime',
        'fecha_modifico' => 'datetime',
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



    public function productos()
    {
        return $this->hasMany(InvProducto::class, 'categoria_id');
    }

}
