<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'sis_tipo_documentos';
    public $timestamps = false;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'abreviatura',
        'estado',
    ];

    /**
     * Obtener todas las personas que tienen este tipo de documento
     */
    public function personas()
    {
        return $this->hasMany(Persona::class);
    }
}
