<?php

namespace App\Http\Controllers;

use App\Models\SStB;
use App\Models\Area;
use App\Models\User;
use App\Models\Entity;
use App\Models\CsNorma;
use App\Models\Empleado;
use App\Models\CsGrupoNorma;
use App\Models\CsTpoBitacora;
use App\Models\CsTpoDeteccion;
use App\Models\BitacoraSeguridad;
use App\Models\CsTpoInconformidade;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitacoraSeguridadsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class BitacoraSeguridadsController extends Controller
{

    /**
     * Display a listing of the bitacora seguridads.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitacoraSeguridad::where('id', '<>', '0');
                $sStBs = SStB::pluck('estatus','id')->all();
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['area_id']) and $input['area_id']<>null){
			$r->where('area_id', '=', $input['area_id']);
		}
                if(isset($input['tpo_deteccion_id']) and $input['tpo_deteccion_id']<>null){
			$r->where('tpo_deteccion_id', '=', $input['tpo_deteccion_id']);
		}
                if(isset($input['tpo_inconformidad_id']) and $input['tpo_inconformidad_id']<>null){
			$r->where('tpo_inconformidad_id', '=', $input['tpo_inconformidad_id']);
		}
                if (Auth::user()->canDo('filtro_entity')) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                $csTpoDeteccions = CsTpoDeteccion::pluck('tpo_deteccion','id')->all();
                $areas = Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id')->all();
                $csTpoBitacoras = CsTpoBitacora::pluck('tpo_bitacora','id')->all();
                $csTpoInconformidades = CsTpoInconformidade::pluck('tpo_inconformidad','id')->all();
		$bitacoraSeguridads = $r->with('cstpodeteccion','area','cstpobitacora','cstpoinconformidade','csgruponorma','csnorma','empleado','sstb','entity','user')->paginate(25);
		//$bitacoraSeguridads = BitacoraSeguridad::with('cstpodeteccion','area','cstpobitacora','cstpoinconformidade','csgruponorma','csnorma','empleado','sstb','entity','user')->paginate(25);

        return view('bitacora_seguridads.index', compact('bitacoraSeguridads','sStBs','areas','csTpoDeteccions','csTpoBitacoras','csTpoInconformidades'));
    }

    /**
     * Show the form for creating a new bitacora seguridad.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $csTpoDeteccions = CsTpoDeteccion::pluck('tpo_deteccion','id')->all();
        $areas = Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id')->all();
        $csTpoBitacoras = CsTpoBitacora::pluck('tpo_bitacora','id')->all();
        $csTpoInconformidades = CsTpoInconformidade::pluck('tpo_inconformidad','id')->all();
        $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
        $csNormas = CsNorma::pluck('norma','id')->all();
        $empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
        $sStBs = SStB::pluck('id','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('bitacora_seguridads.create', compact('csTpoDeteccions','areas','csTpoBitacoras','csTpoInconformidades','csGrupoNormas','csNormas','empleados','sStBs','entities','users','users'));
    }

    /**
     * Store a new bitacora seguridad in the storage.
     *
     * @param App\Http\Requests\BitacoraSeguridadsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitacoraSeguridadsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            $data['anio']=date('Y', strtotime($request->get('fecha')));;
            $data['mes']=date('m', strtotime($request->get('fecha')));
            $data['estatus_id']=1;
            try{
                BitacoraSeguridad::create($data);
            }catch(Exception $e)
            {
                dd($e);
            }

            return redirect()->route('bitacora_seguridads.bitacora_seguridad.index')
                             ->with('success_message', trans('bitacora_seguridads.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_seguridads.unexpected_error')]);
        }
    }

    /**
     * Display the specified bitacora seguridad.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitacoraSeguridad = BitacoraSeguridad::with('cstpodeteccion','area','cstpobitacora','cstpoinconformidade','csgruponorma','csnorma','empleado','sstb','entity','user')->findOrFail($id);

        return view('bitacora_seguridads.show', compact('bitacoraSeguridad'));
    }

    /**
     * Show the form for editing the specified bitacora seguridad.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitacoraSeguridad = BitacoraSeguridad::findOrFail($id);
        $csTpoDeteccions = CsTpoDeteccion::pluck('tpo_deteccion','id')->all();
$areas = Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id')->all();
$csTpoBitacoras = CsTpoBitacora::pluck('tpo_bitacora','id')->all();
$csTpoInconformidades = CsTpoInconformidade::pluck('tpo_inconformidad','id')->all();
$csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
$csNormas = CsNorma::pluck('norma','id')->all();
$empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
$sStBs = SStB::pluck('id','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();

        return view('bitacora_seguridads.edit', compact('bitacoraSeguridad','csTpoDeteccions','areas','csTpoBitacoras','csTpoInconformidades','csGrupoNormas','csNormas','empleados','sStBs','entities','users','users'));
    }

    /**
     * Update the specified bitacora seguridad in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitacoraSeguridadsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitacoraSeguridadsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitacoraSeguridad = BitacoraSeguridad::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            $data['anio']=date('Y', strtotime($request->get('fecha')));;
            $data['mes']=date('m', strtotime($request->get('fecha')));
            $bitacoraSeguridad->update($data);

            return redirect()->route('bitacora_seguridads.bitacora_seguridad.index')
                             ->with('success_message', trans('bitacora_seguridads.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_seguridads.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bitacora seguridad from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitacoraSeguridad = BitacoraSeguridad::findOrFail($id);
            $bitacoraSeguridad->delete();

            return redirect()->route('bitacora_seguridads.bitacora_seguridad.index')
                             ->with('success_message', trans('bitacora_seguridads.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_seguridads.unexpected_error')]);
        }
    }



}
