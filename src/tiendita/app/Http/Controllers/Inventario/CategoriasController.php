<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\InvCategoria;

class CategoriasController extends Controller
{
    /**
     * Mostrar todos los proveedores
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        //$categorias = DB::select('SELECT * FROM inv_categorias');
        $page = $request->get('page', 1);

        $perPage = 15;


        $categorias = InvCategoria::paginate($perPage, ['*'], 'page', $page);

        return Inertia::render('Inventario/Categorias/Index',
        [
            'categorias' => $categorias
        ]
    );
    }


}
