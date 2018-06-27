<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\BitSt;
use App\Models\Entity;
use App\Models\Empleado;
use App\Models\BitacoraPendiente;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitacoraPendientesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class BitacoraPendientesController extends Controller
{

    /**
     * Display a listing of the bitacora pendientes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitacoraPendiente::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$bitacoraPendientes = $r->with('bnd','empleado','bitst','entity','user')->paginate(25);
		//$bitacoraPendientes = BitacoraPendiente::with('bnd','empleado','bitst','entity','user')->paginate(25);

        return view('bitacora_pendientes.index', compact('bitacoraPendientes'));
    }

    /**
     * Show the form for creating a new bitacora pendiente.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $bitSts = BitSt::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('bitacora_pendientes.create', compact('bnds','empleados','bitSts','entities','users','users'));
    }

    /**
     * Store a new bitacora pendiente in the storage.
     *
     * @param App\Http\Requests\BitacoraPendientesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitacoraPendientesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['cia_id']=Auth::user()->entity_id;
            $data['bit_st_id']=1;
            BitacoraPendiente::create($data);

            return redirect()->route('bitacora_pendientes.bitacora_pendiente.index')
                             ->with('success_message', trans('bitacora_pendientes.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_pendientes.unexpected_error')]);
        }
    }

    /**
     * Display the specified bitacora pendiente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitacoraPendiente = BitacoraPendiente::with('bnd','empleado','bitst','entity','user')->findOrFail($id);

        return view('bitacora_pendientes.show', compact('bitacoraPendiente'));
    }

    /**
     * Show the form for editing the specified bitacora pendiente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitacoraPendiente = BitacoraPendiente::findOrFail($id);
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $bitSts = BitSt::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('bitacora_pendientes.edit', compact('bitacoraPendiente','bnds','empleados','bitSts','entities','users','users'));
    }

    /**
     * Update the specified bitacora pendiente in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitacoraPendientesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitacoraPendientesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitacoraPendiente = BitacoraPendiente::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $bitacoraPendiente->update($data);

            return redirect()->route('bitacora_pendientes.bitacora_pendiente.index')
                             ->with('success_message', trans('bitacora_pendientes.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_pendientes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bitacora pendiente from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitacoraPendiente = BitacoraPendiente::findOrFail($id);
            $bitacoraPendiente->delete();

            return redirect()->route('bitacora_pendientes.bitacora_pendiente.index')
                             ->with('success_message', trans('bitacora_pendientes.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_pendientes.unexpected_error')]);
        }
    }



}
