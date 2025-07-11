<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisGenero extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'sis_generos';


    public $timestamps = false;
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
     * Atributos que deben ser convertidos
     *
     * @var array
     */
    protected $casts = [
        'estado' => 'boolean',
    ];

    /**
     * Relación con personas que tienen este género
     */
    public function personas()
    {
        return $this->hasMany(SisPersona::class, 'genero_id');
    }
}
