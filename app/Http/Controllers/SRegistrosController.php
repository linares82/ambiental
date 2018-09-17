<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\CsNorma;
use App\Models\Empleado;
use App\Models\SRegistro;
use App\Models\CsGrupoNorma;
use App\Http\Controllers\Controller;
use App\Models\CsElementosInspeccion;
use App\Models\SEstatusProcedimiento;
use App\Http\Requests\SRegistrosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class SRegistrosController extends Controller
{

    /**
     * Display a listing of the s registros.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=SRegistro::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['grupo_id']) and $input['grupo_id']<>null){
			$r->where('grupo_id', '=', $input['grupo_id']);
		}
                if(isset($input['norma_id']) and $input['norma_id']<>null){
			$r->where('norma_id', '=', $input['norma_id']);
		}
                if(isset($input['elemento_id']) and $input['elemento_id']<>null){
			$r->where('elemento_id', '=', $input['elemento_id']);
		}
                if(isset($input['fec_fin_vigencia']) and $input['fec_fin_vigencia']<>null){
			$r->where('fec_fin_vigencia', '=', date_format(date_create($input['fec_fin_vigencia']),'Y/m/d'));
		}
                $entity=Entity::find(Auth::user()->entity_id);
                if (Auth::user()->canDo('filtro_entity') or $entity->filtred_by_entity==1) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
                $csNormas = CsNorma::pluck('norma','id')->all();
                $sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
                $csElementosInspeccions = CsElementosInspeccion::pluck('elemento','id')->all();
		$sRegistros = $r->with('csgruponorma','csnorma','cselementosinspeccion','bnd','empleado','sestatusprocedimiento','entity','user')->paginate(25);
		//$sRegistros = SRegistro::with('csgruponorma','csnorma','cselementosinspeccion','bnd','empleado','sestatusprocedimiento','entity','user')->paginate(25);

        return view('s_registros.index', compact('sRegistros','sEstatusProcedimientos','csGrupoNormas','csNormas','csElementosInspeccions'));
    }

    /**
     * Show the form for creating a new s registro.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
        $csNormas = CsNorma::pluck('norma','id')->all();
        $csElementosInspeccions = CsElementosInspeccion::pluck('elemento','id')->all();
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
        $sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('s_registros.create', compact('csGrupoNormas','csNormas','csElementosInspeccions','bnds','empleados','sEstatusProcedimientos','entities','users','users'));
    }

    /**
     * Store a new s registro in the storage.
     *
     * @param App\Http\Requests\SRegistrosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SRegistrosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
	    $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            $data['estatus_id']=1;
            $data['archivo']="";
            SRegistro::create($data);

            return redirect()->route('s_registros.s_registro.index')
                             ->with('success_message', trans('s_registros.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_registros.unexpected_error')]);
        }
    }

    /**
     * Display the specified s registro.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $sRegistro = SRegistro::with('csgruponorma','csnorma','cselementosinspeccion','bnd','empleado','sestatusprocedimiento','entity','user')->findOrFail($id);

        return view('s_registros.show', compact('sRegistro'));
    }

    /**
     * Show the form for editing the specified s registro.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sRegistro = SRegistro::findOrFail($id);
        $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
        $csNormas = CsNorma::pluck('norma','id')->all();
        $csElementosInspeccions = CsElementosInspeccion::pluck('elemento','id')->all();
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
        $sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('s_registros.edit', compact('sRegistro','csGrupoNormas','csNormas','csElementosInspeccions','bnds','empleados','sEstatusProcedimientos','entities','users','users'));
    }

    /**
     * Update the specified s registro in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SRegistrosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SRegistrosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $sRegistro = SRegistro::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $sRegistro->update($data);

            return redirect()->route('s_registros.s_registro.index')
                             ->with('success_message', trans('s_registros.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_registros.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified s registro from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sRegistro = SRegistro::findOrFail($id);
            $sRegistro->delete();

            return redirect()->route('s_registros.s_registro.index')
                             ->with('success_message', trans('s_registros.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_registros.unexpected_error')]);
        }
    }



}
