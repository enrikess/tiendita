<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvSubcategoria extends Model
{
    //
    use HasFactory;
    protected $table = 'inv_subcategorias';

    public $timestamps = false;

    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'estado',
        'usuario_creo',
        'fecha_creo',
        'usuario_modifico',
        'fecha_modifico',
        'eliminado',
        'usuario_elimino',
        'motivo_elimino',
        'fecha_elimino'
    ];

    protected $casts = [
        'estado' => 'boolean',
        'fecha_creo' => 'datetime',
        'fecha_modifico' => 'datetime',
        'fecha_elimino' => 'datetime',
    ];

    public function categoria()
    {
        return $this->belongsTo(InvCategoria::class, 'categoria_id');
    }

    public function productos()
    {
        return $this->hasMany(InvProducto::class, 'subcategoria_id');
    }

}
