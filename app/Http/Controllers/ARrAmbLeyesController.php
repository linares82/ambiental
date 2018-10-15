<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\CaAaDoc;
use App\Models\ARrAmbLeye;
use App\Models\ARrAmbientale;
use App\Models\CaMaterial;
use App\Models\CaCategoria;
use App\Http\Controllers\Controller;
use App\Http\Requests\ARrAmbLeyesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ARrAmbLeyesController extends Controller
{

    /**
     * Display a listing of the a rr amb leyes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
                //dd($input);
		$r=ARrAmbLeye::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['material_id']) and $input['material_id']<>null){
			$r->where('material_id', '=', $input['material_id']);
		}
                if(isset($input['categoria_id']) and $input['categoria_id']<>null){
			$r->where('categoria_id', '=', $input['categoria_id']);
		}
                if(isset($input['documento_id']) and $input['documento_id']<>null){
			$r->where('documento_id', '=', $input['documento_id']);
		}
                //$entity=Entity::find(Auth::user()->entity_id);
                if(isset($input['entity_id']) and $input['entity_id']<>null){
                    //dd('si puede');
                    $r->where('entity_id', '=', $input['entity_id']);
                }
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                $entities = Entity::pluck('rzon_social','id')->all();
                $caMaterials = CaMaterial::pluck('material','id')->all();
                $caCategorias = CaCategoria::pluck('categoria','id')->all();
                $caAaDocs = CaAaDoc::pluck('doc','id')->all();
		$aRrAmbLeyes = $r->with('camaterial','cacategoria','caaadoc','bnd','entity','user')->paginate(25);
                //dd($aRrAmbLeyes->toArray());
		//$aRrAmbLeyes = ARrAmbLeye::with('camaterial','cacategoria','caaadoc','bnd','entity','user')->paginate(25);

        return view('a_rr_amb_leyes.index', compact('aRrAmbLeyes','entities','caMaterials','caCategorias','caAaDocs','aRrAmbLeyes'));
    }

    /**
     * Show the form for creating a new a rr amb leye.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caMaterials = CaMaterial::pluck('material','id')->all();
$caCategorias = CaCategoria::pluck('categoria','id')->all();
$caAaDocs = CaAaDoc::pluck('doc','id')->all();
$bnds = Bnd::where('id','>',0)->pluck('bnd','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('a_rr_amb_leyes.create', compact('caMaterials','caCategorias','caAaDocs','bnds','entities','users','users'));
    }

    /**
     * Store a new a rr amb leye in the storage.
     *
     * @param App\Http\Requests\ARrAmbLeyesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ARrAmbLeyesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            ARrAmbLeye::create($data);

            return redirect()->route('a_rr_amb_leyes.a_rr_amb_leye.index')
                             ->with('success_message', trans('a_rr_amb_leyes.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_rr_amb_leyes.unexpected_error')]);
        }
    }

    /**
     * Display the specified a rr amb leye.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aRrAmbLeye = ARrAmbLeye::with('camaterial','cacategoria','caaadoc','bnd','entity','user')->findOrFail($id);

        return view('a_rr_amb_leyes.show', compact('aRrAmbLeye'));
    }

    /**
     * Show the form for editing the specified a rr amb leye.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aRrAmbLeye = ARrAmbLeye::findOrFail($id);
        $caMaterials = CaMaterial::pluck('material','id')->all();
$caCategorias = CaCategoria::pluck('categoria','id')->all();
$caAaDocs = CaAaDoc::pluck('doc','id')->all();
$bnds = Bnd::where('id','>',0)->pluck('bnd','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();

        return view('a_rr_amb_leyes.edit', compact('aRrAmbLeye','caMaterials','caCategorias','caAaDocs','bnds','entities','users','users'));
    }

    /**
     * Update the specified a rr amb leye in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ARrAmbLeyesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ARrAmbLeyesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aRrAmbLeye = ARrAmbLeye::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aRrAmbLeye->update($data);

            return redirect()->route('a_rr_amb_leyes.a_rr_amb_leye.index')
                             ->with('success_message', trans('a_rr_amb_leyes.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_rr_amb_leyes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a rr amb leye from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aRrAmbLeye = ARrAmbLeye::findOrFail($id);
            $aRrAmbLeye->delete();

            return redirect()->route('a_rr_amb_leyes.a_rr_amb_leye.index')
                             ->with('success_message', trans('a_rr_amb_leyes.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_rr_amb_leyes.unexpected_error')]);
        }
    }

    public function generar(Request $request){
        $datos=$request->all();
        //dd($datos);
        $documento=ARrAmbLeye::find($datos['id']);
        $registrosActivos=ARrAmbLeye::where('entity_id',$documento->entity_id)->where('activo',1)->get();
        $registrosExistentes= ARrAmbientale::where('entity_id',$documento->entity_id)->get();
        foreach($registrosActivos as $registro){
            $regRevisar=ARrAmbientale::where('material_id',$registro->material_id)
                                     ->where('categoria_id',$registro->categoria_id)
                                     ->where('documento_id',$registro->documento_id)
                                     ->where('descripcion',$registro->descripcion)
                                     ->first();
            if(count($regRevisar)==0){
                $nuevo=new ARrAmbientale;
                $nuevo->material_id=$registro->material_id;
                $nuevo->categoria_id=$registro->categoria_id;
                $nuevo->documento_id=$registro->documento_id;
                $nuevo->descripcion=$registro->descripcion;
                $nuevo->fec_fin_vigencia=$registro->fec_fin_vigencia;
                $nuevo->aviso=$registro->aviso;
                $nuevo->dias_aviso=$registro->dias_aviso;
                $nuevo->usu_alta_id=$registro->usu_alta_id;
                $nuevo->usu_mod_id=$registro->usu_mod_id;
                $nuevo->archivo="";
                $nuevo->responsable_id=1;
                $nuevo->st_rr_id=1;
                $nuevo->entity_id=$registro->entity_id;
                
                $nuevo->save();
            }
            return redirect()->route('a_rr_amb_leyes.a_rr_amb_leye.index')
                    ->with('success_message', 'Proceso Terminado');
        }
    }

}
