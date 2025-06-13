<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvMarca extends Model
{
    use HasFactory;

    protected $table = 'inv_marcas';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'estado'
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function productos()
    {
        return $this->hasMany(InvProducto::class, 'marca_id');
    }


}
