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

    public $timestamps = false;
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


    protected $casts = [
        'tipo' => TipoUbicacion::class,
        'estado' => 'boolean',
    ];

    /**
     * Obtener la categoría a la que pertenece esta ubicación.
     */
    public function categoria()
    {
        return $this->belongsTo(InvCategoria::class, 'categoria_id');
    }

    /**
     * Obtener los productos asociados a esta ubicación.
     */
    public function productos()
    {
        return $this->hasMany(InvProducto::class, 'ubicacion_id');
    }
}
