<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovTipoMovimiento extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo
     *
     * @var string
     * 
     */
    protected $table = 'mov_tipo_movimientos';
    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'estado',
    ];
    /**
     * Relación con movimientos que tienen este tipo
     */
    public function movimientos()
    {
        return $this->hasMany(MovMovimiento::class, 'tipo_movimiento_id');
    }                    
}
