<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaMaterial;
use App\Models\CaCategoria;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaCategoriasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaCategoriasController extends Controller
{

    /**
     * Display a listing of the ca categorias.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaCategoria::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$caCategorias = $r->with('camaterial','user')->paginate(25);
		//$caCategorias = CaCategoria::with('camaterial','user')->paginate(25);

        return view('ca_categorias.index', compact('caCategorias'));
    }

    /**
     * Show the form for creating a new ca categoria.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caMaterials = CaMaterial::pluck('material','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('ca_categorias.create', compact('caMaterials','users','users'));
    }

    /**
     * Store a new ca categoria in the storage.
     *
     * @param App\Http\Requests\CaCategoriasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaCategoriasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaCategoria::create($data);

            return redirect()->route('ca_categorias.ca_categoria.index')
                             ->with('success_message', trans('ca_categorias.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_categorias.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca categoria.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caCategoria = CaCategoria::with('camaterial','user')->findOrFail($id);

        return view('ca_categorias.show', compact('caCategoria'));
    }

    /**
     * Show the form for editing the specified ca categoria.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caCategoria = CaCategoria::findOrFail($id);
        $caMaterials = CaMaterial::pluck('material','id')->all();
$users = User::pluck('name','id')->all();

        return view('ca_categorias.edit', compact('caCategoria','caMaterials','users','users'));
    }

    /**
     * Update the specified ca categoria in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaCategoriasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaCategoriasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caCategoria = CaCategoria::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caCategoria->update($data);

            return redirect()->route('ca_categorias.ca_categoria.index')
                             ->with('success_message', trans('ca_categorias.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_categorias.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca categoria from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caCategoria = CaCategoria::findOrFail($id);
            $caCategoria->delete();

            return redirect()->route('ca_categorias.ca_categoria.index')
                             ->with('success_message', trans('ca_categorias.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_categorias.unexpected_error')]);
        }
    }



}
