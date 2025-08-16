<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'ruta',
        'icono',
        'parent_id',
        'orden',
        'permiso', // aquí guardamos el name del permiso de Spatie
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('orden');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_role');
    }

}
