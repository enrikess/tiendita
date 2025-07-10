<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\InvSubcategoria;
use App\Models\InvCategoria;
use App\Http\Requests\Subcategoria\StoreSubcategoriaRequest;
use App\Http\Requests\Subcategoria\UpdateSubcategoriaRequest;

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
        $page = $request->get('page', 1);
        $perPage = $request->get('per_page', 5);

        $subcategorias = InvSubcategoria::paginate($perPage, ['*'], 'page', $page);

        return Inertia::render('Inventario/Subcategorias/Index',
        [
            'subcategorias' => $subcategorias,
        ]
    );
    }

    public function create()
    {
        $categorias= Invcategoria::where("estado", true)->get();
        return Inertia::render('Inventario/Subcategorias/Create',[   
            'categorias'=>$categorias
        ]

        );
    }

    public function store(StoreSubcategoriaRequest $request){

            $validated=$request->validated();

            $validated['usuario_creo']=Auth::id();
            $valitaded['fecha_creo']=now();

            $subCategoria= InvSubcategoria::create($validated);

            return redirect()->route('inventario.subcategorias.index')
            ->with('success','Subcategoria creada correctamente');     
    }

    public function edit($id)
    {
        $subcategoria= Invsubcategoria::find($id);
        $categorias= Invcategoria::where("estado", true)->get();

        return Inertia::render('Inventario/Subcategorias/Edit',[   
            'subcategorias'=>$subcategoria,
            'categorias'=>$categorias
        ]

        );
    }

    public function update(UpdateSubcategoriaRequest $request,$id){
        $subcategoria= Invsubcategoria::find($id);
        $validated=$request->validated();
        $validated['usuario_modifico']=Auth::id();
        $valitaded['fecha_modifico']=now();

        $subcategoria->update($validated);

        return redirect()->route('inventario.subcategorias.index')
            ->with('success','Subcategoria actualizada correctamente');     
    }
    

}
