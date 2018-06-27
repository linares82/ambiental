<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\Turno;
use App\Models\Entity;
use App\Models\Empleado;
use App\Models\CsAccione;
use App\Models\CsAccidente;
use App\Models\BitacoraAccidente;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitacoraAccidentesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class BitacoraAccidentesController extends Controller
{

    /**
     * Display a listing of the bitacora accidentes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitacoraAccidente::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$bitacoraAccidentes = $r->with('area','empleado','csaccidente','csaccione','turno','entity','user')->paginate(25);
		//$bitacoraAccidentes = BitacoraAccidente::with('area','empleado','csaccidente','csaccione','turno','entity','user')->paginate(25);

        return view('bitacora_accidentes.index', compact('bitacoraAccidentes'));
    }

    /**
     * Show the form for creating a new bitacora accidente.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $areas = Area::pluck('area','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $csAccidentes = CsAccidente::pluck('accidente','id')->all();
        $csAcciones = CsAccione::pluck('accion','id')->all();
        $turnos = Turno::pluck('turno','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('bitacora_accidentes.create', compact('areas','empleados','empleados','csAccidentes','csAcciones','turnos','entities','users','users'));
    }

    /**
     * Store a new bitacora accidente in the storage.
     *
     * @param App\Http\Requests\BitacoraAccidentesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitacoraAccidentesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
	    $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            BitacoraAccidente::create($data);

            return redirect()->route('bitacora_accidentes.bitacora_accidente.index')
                             ->with('success_message', trans('bitacora_accidentes.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_accidentes.unexpected_error')]);
        }
    }

    /**
     * Display the specified bitacora accidente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitacoraAccidente = BitacoraAccidente::with('area','empleado','csaccidente','csaccione','turno','entity','user')->findOrFail($id);

        return view('bitacora_accidentes.show', compact('bitacoraAccidente'));
    }

    /**
     * Show the form for editing the specified bitacora accidente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitacoraAccidente = BitacoraAccidente::findOrFail($id);
        $areas = Area::pluck('area','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $csAccidentes = CsAccidente::pluck('accidente','id')->all();
        $csAcciones = CsAccione::pluck('accion','id')->all();
        $turnos = Turno::pluck('turno','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('bitacora_accidentes.edit', compact('bitacoraAccidente','areas','empleados','empleados','csAccidentes','csAcciones','turnos','entities','users','users'));
    }

    /**
     * Update the specified bitacora accidente in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitacoraAccidentesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitacoraAccidentesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitacoraAccidente = BitacoraAccidente::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $bitacoraAccidente->update($data);

            return redirect()->route('bitacora_accidentes.bitacora_accidente.index')
                             ->with('success_message', trans('bitacora_accidentes.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_accidentes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bitacora accidente from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitacoraAccidente = BitacoraAccidente::findOrFail($id);
            $bitacoraAccidente->delete();

            return redirect()->route('bitacora_accidentes.bitacora_accidente.index')
                             ->with('success_message', trans('bitacora_accidentes.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_accidentes.unexpected_error')]);
        }
    }



}
