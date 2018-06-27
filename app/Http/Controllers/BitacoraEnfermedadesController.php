<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\Turno;
use App\Models\Entity;
use App\Models\Empleado;
use App\Models\CsAccione;
use App\Models\CsEnfermedade;
use App\Models\BitacoraEnfermedade;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitacoraEnfermedadesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class BitacoraEnfermedadesController extends Controller
{

    /**
     * Display a listing of the bitacora enfermedades.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitacoraEnfermedade::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$bitacoraEnfermedades = $r->with('area','empleado','csenfermedade','csaccione','turno','entity','user')->paginate(25);
		//$bitacoraEnfermedades = BitacoraEnfermedade::with('area','empleado','csenfermedade','csaccione','turno','entity','user')->paginate(25);

        return view('bitacora_enfermedades.index', compact('bitacoraEnfermedades'));
    }

    /**
     * Show the form for creating a new bitacora enfermedade.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $areas = Area::pluck('area','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $csEnfermedades = CsEnfermedade::pluck('enfermedad','id')->all();
        $csAcciones = CsAccione::pluck('accion','id')->all();
        $turnos = Turno::pluck('turno','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('bitacora_enfermedades.create', compact('areas','empleados','csEnfermedades','csAcciones','turnos','entities','users','users'));
    }

    /**
     * Store a new bitacora enfermedade in the storage.
     *
     * @param App\Http\Requests\BitacoraEnfermedadesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitacoraEnfermedadesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            BitacoraEnfermedade::create($data);

            return redirect()->route('bitacora_enfermedades.bitacora_enfermedade.index')
                             ->with('success_message', trans('bitacora_enfermedades.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_enfermedades.unexpected_error')]);
        }
    }

    /**
     * Display the specified bitacora enfermedade.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitacoraEnfermedade = BitacoraEnfermedade::with('area','empleado','csenfermedade','csaccione','turno','entity','user')->findOrFail($id);

        return view('bitacora_enfermedades.show', compact('bitacoraEnfermedade'));
    }

    /**
     * Show the form for editing the specified bitacora enfermedade.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitacoraEnfermedade = BitacoraEnfermedade::findOrFail($id);
        $areas = Area::pluck('area','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $csEnfermedades = CsEnfermedade::pluck('enfermedad','id')->all();
        $csAcciones = CsAccione::pluck('accion','id')->all();
        $turnos = Turno::pluck('turno','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('bitacora_enfermedades.edit', compact('bitacoraEnfermedade','areas','empleados','csEnfermedades','csAcciones','turnos','entities','users','users'));
    }

    /**
     * Update the specified bitacora enfermedade in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitacoraEnfermedadesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitacoraEnfermedadesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitacoraEnfermedade = BitacoraEnfermedade::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $bitacoraEnfermedade->update($data);

            return redirect()->route('bitacora_enfermedades.bitacora_enfermedade.index')
                             ->with('success_message', trans('bitacora_enfermedades.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_enfermedades.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bitacora enfermedade from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitacoraEnfermedade = BitacoraEnfermedade::findOrFail($id);
            $bitacoraEnfermedade->delete();

            return redirect()->route('bitacora_enfermedades.bitacora_enfermedade.index')
                             ->with('success_message', trans('bitacora_enfermedades.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_enfermedades.unexpected_error')]);
        }
    }



}
