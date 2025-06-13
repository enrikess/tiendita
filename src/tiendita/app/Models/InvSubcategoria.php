<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvSubcategoria extends Model
{
    //
    protected $table = 'inv_subcategorias';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'categoria_id'
    ];

    protected $casts = [
        'estado' => 'boolean',
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
