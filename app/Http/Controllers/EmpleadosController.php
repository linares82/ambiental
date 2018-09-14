<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\Area;
use App\Models\User;
use App\Models\Puesto;
use App\Models\Entity;
use App\Models\Empleado;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmpleadosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class EmpleadosController extends Controller
{

    /**
     * Display a listing of the empleados.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Empleado::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['nombre']) and $input['nombre']<>null){
			$r->where('nombre', 'like', '%'.$input['nombre']."%");
		}
                if (Auth::user()->canDo('filtro_entity')) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
                
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$empleados = $r->with('area','puesto','bnd','user','entity')->paginate(25);
		//$empleados = Empleado::with('area','puesto','bnd','jefe','user','entity')->paginate(25);

        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new empleado.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $areas = Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id')->all();
        $puestos = Puesto::where('entity_id',Auth::user()->entity_id)->pluck('puesto','id')->all();
        $bnds = Bnd::where('id','>',0)->pluck('bnd','id')->all();
        $jeves = Empleado::where('bnd_subordinados', '=', 1)->pluck('nombre','id')->all();
        $users = User::pluck('name','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        
        return view('empleados.create', compact('areas','puestos','bnds','jeves','users','entities','users','users'));
    }

    /**
     * Store a new empleado in the storage.
     *
     * @param App\Http\Requests\EmpleadosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EmpleadosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $data['usu_alta_id']=Auth::user()->id;
            $data['usu_mod_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            Empleado::create($data);

            return redirect()->route('empleados.empleado.index')
                             ->with('success_message', trans('empleados.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('empleados.unexpected_error')]);
        }
    }

    /**
     * Display the specified empleado.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $empleado = Empleado::with('area','puesto','bnd','jefe','user','entity')->findOrFail($id);

        return view('empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified empleado.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        $areas = Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id')->all();
        $puestos = Puesto::where('entity_id',Auth::user()->entity_id)->pluck('puesto','id')->all();
        $bnds = Bnd::where('id','>',0)->pluck('bnd','id')->all();
        $jeves = Empleado::where('bnd_subordinados', '=', 1)->pluck('nombre','id')->all();
        $users = User::pluck('name','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        //dd($bnds);
        return view('empleados.edit', compact('empleado','areas','puestos','bnds','jeves','users','entities','users','users'));
    }

    /**
     * Update the specified empleado in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EmpleadosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EmpleadosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $empleado = Empleado::findOrFail($id);
            $data['usu_mod_id']=Auth::user()->id;
            $empleado->update($data);

            return redirect()->route('empleados.empleado.index')
                             ->with('success_message', trans('empleados.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('empleados.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified empleado from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $empleado = Empleado::findOrFail($id);
            $empleado->delete();

            return redirect()->route('empleados.empleado.index')
                             ->with('success_message', trans('empleados.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('empleados.unexpected_error')]);
        }
    }



}
