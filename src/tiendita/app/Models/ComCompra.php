<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComCompra extends Model
{
    protected $table = 'com_compras';

    protected $fillable = [
        'numero_compra',
        'proveedor_id',
        'fecha_compra',
        'subtotal',
        'igv_total',
        'total',
        'estado_compra_id',
        'usuario_creo',
        'fecha_creo',
        'usuario_modifico',
        'fecha_modifico',
        'eliminado',
        'usuario_elimino',
        'motivo_elimino',
        'fecha_elimino',
    ];

    public $timestamps = false;

    /**
     * Accesor para mostrar el número formateado
     *
     * @return string
     */
    public function getNumeroCompraFormateadoAttribute(): string
    {
        return 'COM-' . str_pad($this->numero_compra, 8, '0', STR_PAD_LEFT);
    }

    /**
     * Relación con el proveedor
     */
    public function proveedor()
    {
        return $this->belongsTo(ComProveedor::class, 'proveedor_id');
    }

    /**
     * Relación con el estado de la compra
     */
    public function estadoCompra()
    {
        return $this->belongsTo(ComEstadoCompra::class, 'estado_compra_id');
    }

    /**
     * Relación con el usuario que creó
     */
    public function creadoPor()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_creo');
    }

    /**
     * Relación con el usuario que modificó
     */
    public function modificadoPor()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_modifico');
    }

    /**
     * Relación con el usuario que eliminó
     */
    public function eliminadoPor()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_elimino');
    }
}
