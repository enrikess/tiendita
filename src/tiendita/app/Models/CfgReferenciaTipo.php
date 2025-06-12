<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CfgReferenciaTipo extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'cfg_referencia_tipos';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo',
        'descripcion',
        'activo',
    ];

    /**
     * Indica si el tipo de referencia está activo
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->activo;
    }
}
