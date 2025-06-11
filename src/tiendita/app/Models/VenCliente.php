<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenCliente extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla asociada al modelo
     *
     * @var string
     */
    protected $table = 'ven_clientes';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tipo_documento_id',
        'numero_documento',
        'nombres',
        'apellidos',
        'razon_social',
        'direccion',
        'telefono',
        'email',
        'estado',
        'usuario_creo',
        'fecha_creo'
    ];

    /**
     * Relación con el tipo de documento
     */
    public function tipoDocumento()
    {
        return $this->belongsTo(SisTipoDocumento::class, 'tipo_documento_id');
    }

    /**
     * Relación con el usuario que creó el registro
     */
    public function usuarioCreo()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_creo');
    }
}
