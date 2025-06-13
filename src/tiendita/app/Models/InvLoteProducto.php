<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvLoteProducto extends Model
{
    use HasFactory;

    protected $table = 'inv_lote_productos';

    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'cantidad',
        'lote',
        'fecha_vencimiento',
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
        'cantidad' => 'decimal:2',
        'fecha_vencimiento' => 'date',
        'estado' => 'boolean',
        'fecha_creo' => 'datetime',
        'fecha_modifico' => 'datetime',
        'eliminado' => 'boolean',
        'fecha_elimino' => 'datetime',
    ];

    public function producto()
    {
        return $this->belongsTo(InvProducto::class, 'producto_id');
    }

    public function usuarioCreo()
    {
        return $this->belongsTo(User::class, 'usuario_creo');
    }

    public function usuarioModifico()
    {
        return $this->belongsTo(User::class, 'usuario_modifico');
    }

    public function usuarioElimino()
    {
        return $this->belongsTo(User::class, 'usuario_elimino');
    }

}
