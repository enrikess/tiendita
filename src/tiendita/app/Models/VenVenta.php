<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenVenta extends Model
{
    protected $table = 'ven_ventas';

    protected $fillable = [
        'numero_venta',
        'cliente_id',
        'fecha_venta',
        'subtotal',
        'igv_total',
        'total',
        'metodo_pago_id',
        'estado_venta_id',
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
     * Relación con el cliente
     */
    public function cliente()
    {
        return $this->belongsTo(VenCliente::class, 'cliente_id');
    }

    /**
     * Relación con el método de pago
     */
    public function metodoPago()
    {
        return $this->belongsTo(FinMetodoPago::class, 'metodo_pago_id');
    }

    /**
     * Relación con el estado de venta
     */
    public function estadoVenta()
    {
        return $this->belongsTo(VenEstadoVenta::class, 'estado_venta_id');
    }

    /**
     * Relación con el usuario que creó la venta
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
    public function getNumeroVentaFormateadoAttribute(): string
    {
        return 'VEN-' . str_pad($this->numero_venta, 8, '0', STR_PAD_LEFT);
    }
}
