<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CfgParametroIgv extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'cfg_parametro_igvs';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'porcentaje',
        'fecha_inicio',
        'fecha_fin',
        'activo',
    ];

    /**
     * Indica si el parámetro IGV está activo
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->activo;
    }
}
