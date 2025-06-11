<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisPersona extends Model
{
    use HasFactory;

    protected $table = 'sis_persona';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'ape_paterno',
        'ape_materno',
        'correo',
        'tipo_documento_id',
        'numero_documento',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'genero_id',
        'estado',
        'usuario_creo',
        'usuario_modifico',
        'fecha_creo',
        'fecha_modifico',
        'usuario_elimino',
        'fecha_elimino',
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
     * Obtener el usuario asociado a esta persona
     */
    public function usuario()
    {
        return $this->hasOne(SisUsuario::class);
    }

    /**
     * Obtener el nombre completo de la persona
     */
    public function getNombreCompletoAttribute()
    {
        return "{$this->nombre} {$this->ape_paterno} {$this->ape_materno}";
    }

    /**
     * Obtener el usuario que creó esta persona
     */
    public function usuarioCreo()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_creo');
    }

    /**
     * Obtener el usuario que modificó esta persona
     */
    public function usuarioModifico()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_modifico');
    }

    /**
     * Obtener el usuario que eliminó esta persona
     */
    public function usuarioElimino()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_elimino');
    }
}
