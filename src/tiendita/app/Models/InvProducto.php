<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvProducto extends Model
{

    use HasFactory;


    protected $table = 'inv_productos';

    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'codigo_barras',
        'nombre',
        'descripcion',
        'categoria_id',
        'subcategoria_id',
        'unidad_medida_id',
        'marca_id',
        'precio_compra',
        'precio_venta',
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
        'precio_compra' => 'decimal:2',
        'precio_venta' => 'decimal:2',
        'estado' => 'boolean',
        'fecha_creo' => 'datetime',
        'fecha_modifico' => 'datetime',
        'eliminado' => 'boolean',
        'fecha_elimino' => 'datetime',
    ];

    public function categoria()
    {
        return $this->belongsTo(InvCategoria::class, 'categoria_id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(InvSubcategoria::class, 'subcategoria_id');
    }

    public function unidadMedida()
    {
        return $this->belongsTo(InvUnidadMedida::class, 'unidad_medida_id');
    }

    public function marca()
    {
        return $this->belongsTo(InvMarca::class, 'marca_id');
    }

    public function usuarioCreo()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_creo');
    }

    public function usuarioModifico()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_modifico');
    }

    public function usuarioElimino()
    {
        return $this->belongsTo(SisUsuario::class, 'usuario_elimino');
    }

}
