<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Turno;
use App\Models\Entity;
use App\Models\Empleado;
use App\Models\BitacoraFf;
use App\Models\CaFuentesFija;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitacoraFfsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class BitacoraFfsController extends Controller
{

    /**
     * Display a listing of the bitacora ffs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitacoraFf::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$bitacoraFfs = $r->with('cafuentesfija','turno','empleado','entity','user')->paginate(25);
		//$bitacoraFfs = BitacoraFf::with('cafuentesfija','turno','empleado','entity','user')->paginate(25);

        return view('bitacora_ffs.index', compact('bitacoraFfs'));
    }

    /**
     * Show the form for creating a new bitacora ff.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caFuentesFijas = CaFuentesFija::pluck('planta','id')->all();
        $turnos = Turno::pluck('turno','id')->all();
        $empleados = Empleado::pluck('ctrl_interno','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('bitacora_ffs.create', compact('caFuentesFijas','turnos','empleados','entities','users','users'));
    }

    /**
     * Store a new bitacora ff in the storage.
     *
     * @param App\Http\Requests\BitacoraFfsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitacoraFfsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            $data['anio']=date('Y', strtotime($request->get('fecha')));;
            $data['mes']=date('m', strtotime($request->get('fecha')));
            BitacoraFf::create($data);

            return redirect()->route('bitacora_ffs.bitacora_ff.index')
                             ->with('success_message', trans('bitacora_ffs.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_ffs.unexpected_error')]);
        }
    }

    /**
     * Display the specified bitacora ff.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitacoraFf = BitacoraFf::with('cafuentesfija','turno','empleado','entity','user')->findOrFail($id);

        return view('bitacora_ffs.show', compact('bitacoraFf'));
    }

    /**
     * Show the form for editing the specified bitacora ff.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitacoraFf = BitacoraFf::findOrFail($id);
        $caFuentesFijas = CaFuentesFija::pluck('planta','id')->all();
        $turnos = Turno::pluck('turno','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('bitacora_ffs.edit', compact('bitacoraFf','caFuentesFijas','turnos','empleados','entities','users','users'));
    }

    /**
     * Update the specified bitacora ff in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitacoraFfsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitacoraFfsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitacoraFf = BitacoraFf::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            $data['anio']=date('Y', strtotime($request->get('fecha')));;
            $data['mes']=date('m', strtotime($request->get('fecha')));
            $bitacoraFf->update($data);

            return redirect()->route('bitacora_ffs.bitacora_ff.index')
                             ->with('success_message', trans('bitacora_ffs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_ffs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bitacora ff from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitacoraFf = BitacoraFf::findOrFail($id);
            $bitacoraFf->delete();

            return redirect()->route('bitacora_ffs.bitacora_ff.index')
                             ->with('success_message', trans('bitacora_ffs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_ffs.unexpected_error')]);
        }
    }



}
