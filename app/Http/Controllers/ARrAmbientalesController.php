<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\CaAaDoc;
use App\Models\Empleado;
use App\Models\CaMaterial;
use App\Models\AStArchivo;
use App\Models\CaCategoria;
use App\Models\ARrAmbientale;
use App\Http\Controllers\Controller;
use App\Http\Requests\ARrAmbientalesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ARrAmbientalesController extends Controller
{

    /**
     * Display a listing of the a rr ambientales.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=ARrAmbientale::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                $aStRrs = AStArchivo::pluck('estatus','id')->all();
		$aRrAmbientales = $r->with('camaterial','cacategoria','caaadoc','bnd','empleado','astarchivo','entity','user')->paginate(25);
		//$aRrAmbientales = ARrAmbientale::with('camaterial','cacategoria','caaadoc','bnd','empleado','astarchivo','entity','user')->paginate(25);

        return view('a_rr_ambientales.index', compact('aRrAmbientales','aStRrs'));
    }

    /**
     * Show the form for creating a new a rr ambientale.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caMaterials = CaMaterial::pluck('material','id')->all();
        $caCategorias = CaCategoria::pluck('categoria','id')->all();
        $caAaDocs = CaAaDoc::pluck('doc','id')->all();
        $bnds = Bnd::where('id','>',0)->pluck('bnd','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $aStArchivos = AStArchivo::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('a_rr_ambientales.create', compact('caMaterials','caCategorias','caAaDocs','bnds','empleados','aStArchivos','entities','users','users'));
    }

    /**
     * Store a new a rr ambientale in the storage.
     *
     * @param App\Http\Requests\ARrAmbientalesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ARrAmbientalesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            $data['st_archivo_id']=1;
            ARrAmbientale::create($data);

            return redirect()->route('a_rr_ambientales.a_rr_ambientale.index')
                             ->with('success_message', trans('a_rr_ambientales.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_rr_ambientales.unexpected_error')]);
        }
    }

    /**
     * Display the specified a rr ambientale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aRrAmbientale = ARrAmbientale::with('camaterial','cacategoria','caaadoc','bnd','empleado','astarchivo','entity','user')->findOrFail($id);

        return view('a_rr_ambientales.show', compact('aRrAmbientale'));
    }

    /**
     * Show the form for editing the specified a rr ambientale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aRrAmbientale = ARrAmbientale::findOrFail($id);
        $caMaterials = CaMaterial::pluck('material','id')->all();
        $caCategorias = CaCategoria::pluck('categoria','id')->all();
        $caAaDocs = CaAaDoc::pluck('doc','id')->all();
        $bnds = Bnd::where('id','>',0)->pluck('bnd','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $aStArchivos = AStArchivo::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('a_rr_ambientales.edit', compact('aRrAmbientale','caMaterials','caCategorias','caAaDocs','bnds','empleados','aStArchivos','entities','users','users'));
    }

    /**
     * Update the specified a rr ambientale in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ARrAmbientalesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ARrAmbientalesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aRrAmbientale = ARrAmbientale::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aRrAmbientale->update($data);

            return redirect()->route('a_rr_ambientales.a_rr_ambientale.index')
                             ->with('success_message', trans('a_rr_ambientales.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_rr_ambientales.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a rr ambientale from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aRrAmbientale = ARrAmbientale::findOrFail($id);
            $aRrAmbientale->delete();

            return redirect()->route('a_rr_ambientales.a_rr_ambientale.index')
                             ->with('success_message', trans('a_rr_ambientales.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_rr_ambientales.unexpected_error')]);
        }
    }



}
