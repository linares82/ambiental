<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Area;
use App\Models\AStNc;
use App\Models\Entity;
use App\Models\Empleado;
use App\Models\CaTpoBitacora;
use App\Models\CsTpoDeteccion;
use App\Models\ANoConformidade;
use App\Models\CaTpoNoConformidad;
use App\Http\Controllers\Controller;
use App\Http\Requests\ANoConformidadesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ANoConformidadesController extends Controller
{

    /**
     * Display a listing of the a no conformidades.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=ANoConformidade::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['area_id']) and $input['area_id']<>null){
			$r->where('area_id', '=', $input['area_id']);
		}
                if(isset($input['tpo_deteccion_id']) and $input['tpo_deteccion_id']<>null){
			$r->where('tpo_deteccion_id', '=', $input['tpo_deteccion_id']);
		}
                if(isset($input['fec_planeada']) and $input['fec_planeada']<>null){
			$r->where('fec_planeada', '=', date_format(date_create($input['fec_planeada']),'Y/m/d'));
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                $areas = Area::pluck('area','id')->all();
                $csTpoDeteccions = CsTpoDeteccion::pluck('tpo_deteccion','id')->all();
		$aNoConformidades = $r->with('area','cstpodeteccion','catpobitacora','catponoconformidad','empleado','astnc','entity','user')->paginate(25);
		//$aNoConformidades = ANoConformidade::with('area','cstpodeteccion','catpobitacora','catponoconformidad','empleado','astnc','entity','user')->paginate(25);

        return view('a_no_conformidades.index', compact('aNoConformidades','areas','csTpoDeteccions'));
    }

    /**
     * Show the form for creating a new a no conformidade.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $areas = Area::pluck('area','id')->all();
        $csTpoDeteccions = CsTpoDeteccion::pluck('tpo_deteccion','id')->all();
        $caTpoBitacoras = CaTpoBitacora::pluck('tpo_bitacora','id')->all();
        $caTpoNoConformidads = CaTpoNoConformidad::pluck('tpo_inconformidad','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $aStNcs = AStNc::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('a_no_conformidades.create', compact('areas','csTpoDeteccions','caTpoBitacoras','caTpoNoConformidads','empleados','aStNcs','entities','users','users'));
    }

    /**
     * Store a new a no conformidade in the storage.
     *
     * @param App\Http\Requests\ANoConformidadesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ANoConformidadesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            $data['estatus_id']=1;
            $data['anio']=date('Y', strtotime($request->get('fecha')));;
            $data['mes']=date('m', strtotime($request->get('fecha')));
            ANoConformidade::create($data);

            return redirect()->route('a_no_conformidades.a_no_conformidade.index')
                             ->with('success_message', trans('a_no_conformidades.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_no_conformidades.unexpected_error')]);
        }
    }

    /**
     * Display the specified a no conformidade.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aNoConformidade = ANoConformidade::with('area','cstpodeteccion','catpobitacora','catponoconformidad','empleado','astnc','entity','user')->findOrFail($id);

        return view('a_no_conformidades.show', compact('aNoConformidade'));
    }

    /**
     * Show the form for editing the specified a no conformidade.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aNoConformidade = ANoConformidade::findOrFail($id);
        $areas = Area::pluck('area','id')->all();
        $csTpoDeteccions = CsTpoDeteccion::pluck('tpo_deteccion','id')->all();
        $caTpoBitacoras = CaTpoBitacora::pluck('tpo_bitacora','id')->all();
        $caTpoNoConformidads = CaTpoNoConformidad::pluck('tpo_inconformidad','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $aStNcs = AStNc::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('a_no_conformidades.edit', compact('aNoConformidade','areas','csTpoDeteccions','caTpoBitacoras','caTpoNoConformidads','empleados','aStNcs','entities','users','users'));
    }

    /**
     * Update the specified a no conformidade in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ANoConformidadesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ANoConformidadesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $data['anio']=date('Y', strtotime($request->get('fecha')));;
            $data['mes']=date('m', strtotime($request->get('fecha')));
            $aNoConformidade = ANoConformidade::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aNoConformidade->update($data);

            return redirect()->route('a_no_conformidades.a_no_conformidade.index')
                             ->with('success_message', trans('a_no_conformidades.model_was_updated'));

        } catch (Exception $exception) {
            Log::info($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_no_conformidades.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a no conformidade from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aNoConformidade = ANoConformidade::findOrFail($id);
            $aNoConformidade->delete();

            return redirect()->route('a_no_conformidades.a_no_conformidade.index')
                             ->with('success_message', trans('a_no_conformidades.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_no_conformidades.unexpected_error')]);
        }
    }



}
