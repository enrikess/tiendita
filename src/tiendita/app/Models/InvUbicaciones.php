<?php

namespace App\Models;

use App\Enums\TipoUbicacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvUbicaciones extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'inv_ubicaciones';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'tipo',
        'categoria_id',
        'descripcion',
        'estado',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos específicos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tipo' => TipoUbicacion::class,
        'estado' => 'boolean',
    ];

    /**
     * Relación con la categoría de la ubicación
     */
    public function categoria()
    {
        return $this->belongsTo(InvCategoria::class, 'categoria_id');
    }
}
