<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\Empleado;
use App\Models\CaResiduo;
use App\Models\BitacoraResiduo;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitacoraResiduosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class BitacoraResiduosController extends Controller
{

    /**
     * Display a listing of the bitacora residuos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitacoraResiduo::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['residuo']) and $input['residuo']<>null){
			$r->where('residuo', '=', $input['residuo']);
		}
                if(isset($input['fecha']) and $input['fecha']<>null){
			$r->where('fecha', '=', date_format(date_create($input['fecha']),'Y/m/d'));
		}
                $entity=Entity::find(Auth::user()->entity_id);
                if (Auth::user()->canDo('filtro_entity') or $entity->filtred_by_entity==1) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                $caResiduos = CaResiduo::pluck('residuo','id')->all();
		$bitacoraResiduos = $r->with('caresiduo','bnd','empleado','entity','user')->paginate(25);
		//$bitacoraResiduos = BitacoraResiduo::with('caresiduo','bnd','empleado','entity','user')->paginate(25);

        return view('bitacora_residuos.index', compact('bitacoraResiduos','caResiduos'));
    }

    /**
     * Show the form for creating a new bitacora residuo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caResiduos = CaResiduo::pluck('residuo','id')->all();
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('bitacora_residuos.create', compact('caResiduos','bnds','bnds','bnds','empleados','entities','users','users'));
    }

    /**
     * Store a new bitacora residuo in the storage.
     *
     * @param App\Http\Requests\BitacoraResiduosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitacoraResiduosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            $data['anio']=date('Y', strtotime($request->get('fecha')));;
            $data['mes']=date('m', strtotime($request->get('fecha')));
            BitacoraResiduo::create($data);

            return redirect()->route('bitacora_residuos.bitacora_residuo.index')
                             ->with('success_message', trans('bitacora_residuos.model_was_added'));

        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_residuos.unexpected_error')]);
        }
    }

    /**
     * Display the specified bitacora residuo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitacoraResiduo = BitacoraResiduo::with('caresiduo','bnd','empleado','entity','user')->findOrFail($id);

        return view('bitacora_residuos.show', compact('bitacoraResiduo'));
    }

    /**
     * Show the form for editing the specified bitacora residuo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitacoraResiduo = BitacoraResiduo::findOrFail($id);
        $caResiduos = CaResiduo::pluck('residuo','id')->all();
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('bitacora_residuos.edit', compact('bitacoraResiduo','caResiduos','bnds','bnds','bnds','empleados','entities','users','users'));
    }

    /**
     * Update the specified bitacora residuo in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitacoraResiduosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitacoraResiduosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitacoraResiduo = BitacoraResiduo::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            $data['anio']=date('Y', strtotime($request->get('fecha')));;
            $data['mes']=date('m', strtotime($request->get('fecha')));
            $bitacoraResiduo->update($data);

            return redirect()->route('bitacora_residuos.bitacora_residuo.index')
                             ->with('success_message', trans('bitacora_residuos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_residuos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bitacora residuo from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitacoraResiduo = BitacoraResiduo::findOrFail($id);
            $bitacoraResiduo->delete();

            return redirect()->route('bitacora_residuos.bitacora_residuo.index')
                             ->with('success_message', trans('bitacora_residuos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_residuos.unexpected_error')]);
        }
    }



}
