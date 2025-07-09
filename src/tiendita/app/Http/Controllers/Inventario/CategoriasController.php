<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\InvCategoria;
use App\Http\Requests\Categoria\StoreCategoriaRequest;

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
        $perPage = $request->get('per_page', 5);


        $categorias = InvCategoria::paginate($perPage, ['*'], 'page', $page);



        return Inertia::render('Inventario/Categorias/Index',
        [
            'categorias' => $categorias,
            'porPagina' => $perPage
        ]
        );
    }

    public function create(){
        return Inertia::render('Inventario/Categorias/Create');
    }

    public function store(StoreCategoriaRequest $request){

        $validated = $request->validated();

        $validated['usuario_creo'] = Auth::id();
        $validated['fecha_creo'] = now();

        $categoria = InvCategoria::create($validated);

        return redirect()->route('inventario.categorias.index')
            ->with('success', 'Categoría creada exitosamente');

        //$validated['usuario_creo'] = Auth::id();

        //$estadoCompras = $this->comEstadoCompraService->crear($validated);

    }


}
