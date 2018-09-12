<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Turno;
use App\Models\Entity;
use App\Models\CaPlanta;
use App\Models\Empleado;
use App\Models\BitacoraPlanta;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitacoraPlantasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class BitacoraPlantasController extends Controller
{

    /**
     * Display a listing of the bitacora plantas.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitacoraPlanta::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['planta_id']) and $input['planta_id']<>null){
			$r->where('planta_id', '=', $input['planta_id']);
		}
                if(isset($input['fecha']) and $input['fecha']<>nul){
			$r->where('fecha', '=', date_format(date_create($input['fecha']),'Y/m/d'));
		}
                if (Auth::user()->canDo('filtro_entity')) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                $caPlantas = CaPlanta::pluck('planta','id')->all();
		$bitacoraPlantas = $r->with('caplanta','turno','empleado','entity','user')->paginate(25);
		//$bitacoraPlantas = BitacoraPlanta::with('caplanta','turno','empleado','entity','user')->paginate(25);

        return view('bitacora_plantas.index', compact('bitacoraPlantas','caPlantas'));
    }

    /**
     * Show the form for creating a new bitacora planta.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caPlantas = CaPlanta::pluck('planta','id')->all();
$turnos = Turno::pluck('turno','id')->all();
$empleados = Empleado::pluck('ctrl_interno','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('bitacora_plantas.create', compact('caPlantas','turnos','empleados','entities','users','users'));
    }

    /**
     * Store a new bitacora planta in the storage.
     *
     * @param App\Http\Requests\BitacoraPlantasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitacoraPlantasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['anio']=date('Y', strtotime($request->get('fecha')));;
            $data['mes']=date('m', strtotime($request->get('fecha')));
            BitacoraPlanta::create($data);

            return redirect()->route('bitacora_plantas.bitacora_planta.index')
                             ->with('success_message', trans('bitacora_plantas.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_plantas.unexpected_error')]);
        }
    }

    /**
     * Display the specified bitacora planta.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitacoraPlanta = BitacoraPlanta::with('caplanta','turno','empleado','entity','user')->findOrFail($id);

        return view('bitacora_plantas.show', compact('bitacoraPlanta'));
    }

    /**
     * Show the form for editing the specified bitacora planta.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitacoraPlanta = BitacoraPlanta::findOrFail($id);
        $caPlantas = CaPlanta::pluck('planta','id')->all();
$turnos = Turno::pluck('turno','id')->all();
$empleados = Empleado::pluck('ctrl_interno','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();

        return view('bitacora_plantas.edit', compact('bitacoraPlanta','caPlantas','turnos','empleados','entities','users','users'));
    }

    /**
     * Update the specified bitacora planta in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitacoraPlantasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitacoraPlantasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitacoraPlanta = BitacoraPlanta::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            $data['anio']=date('Y', strtotime($request->get('fecha')));;
            $data['mes']=date('m', strtotime($request->get('fecha')));
            $bitacoraPlanta->update($data);

            return redirect()->route('bitacora_plantas.bitacora_planta.index')
                             ->with('success_message', trans('bitacora_plantas.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_plantas.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bitacora planta from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitacoraPlanta = BitacoraPlanta::findOrFail($id);
            $bitacoraPlanta->delete();

            return redirect()->route('bitacora_plantas.bitacora_planta.index')
                             ->with('success_message', trans('bitacora_plantas.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_plantas.unexpected_error')]);
        }
    }



}
