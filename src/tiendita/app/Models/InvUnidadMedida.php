<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvUnidadMedida extends Model
{
    use HasFactory;

    protected $table = 'inv_unidad_medidas';
    //
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'abreviatura',
        'estado'
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function productos()
    {
        return $this->hasMany(InvProducto::class, 'unidad_medida_id');
    }

}
