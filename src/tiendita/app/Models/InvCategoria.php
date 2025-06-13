<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvCategoria extends Model
{
    use HasFactory;
    //
    protected $table = 'inv_categorias';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function productos()
    {
        return $this->hasMany(InvProducto::class, 'categoria_id');
    }

}
