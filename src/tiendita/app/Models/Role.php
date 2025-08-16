<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_role');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_role');
    }
}
