<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisPersona extends Model
{
    use HasFactory;

    protected $table = 'sis_persona';


    public $timestamps = false;
    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'ape_paterno',
        'ape_materno',
        'email',
        'tipo_documento_id',
        'numero_documento',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'genero_id',
        'estado',
    ];


    protected $casts = [
        'fecha_nacimiento' => 'date',
        'estado' => 'boolean',
    ];

    /**
     * Obtener el tipo de documento asociado a la persona
     */
    public function tipoDocumento()
    {
        return $this->belongsTo(SisTipoDocumento::class, 'tipo_documento_id');
    }

    /**
     * Obtener el género asociado a la persona
     */
    public function genero()
    {
        return $this->belongsTo(SisGenero::class, 'genero_id');
    }

    /**
     * Obtener el nombre completo de la persona
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->ape_paterno} {$this->ape_materno}";
    }

}
