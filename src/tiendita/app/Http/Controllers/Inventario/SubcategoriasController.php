<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\InvSubcategoria;

class SubcategoriasController extends Controller
{
    /**
     * Mostrar todos los proveedores
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        //$subCategoria = DB::select('SELECT * FROM inv_subcategorias');

        $subcategorias = InvSubcategoria::all();

        return Inertia::render('Inventario/Subcategorias/Index',
        [
            'subcategorias' => $subcategorias,
        ]
    );
    }


}
