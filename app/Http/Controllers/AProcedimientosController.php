<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\Empleado;
use App\Models\AStArchivo;
use App\Models\AProcedimiento;
use App\Models\CaProcedimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\AProcedimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AProcedimientosController extends Controller
{

    /**
     * Display a listing of the a procedimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AProcedimiento::where('id', '<>', '0');
                
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['procedimiento_id']) and $input['procedimiento_id']<>null){
			$r->where('procedimiento_id', '=', $input['procedimiento_id']);
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
		$aProcedimientos = $r->with('caprocedimiento','bnd','empleado','astarchivo','entity','user')->paginate(25);
		//$aProcedimientos = AProcedimiento::with('caprocedimiento','bnd','empleado','astarchivo','entity','user')->paginate(25);
                $aStArchivos = AStArchivo::pluck('estatus','id')->all();
                $caProcedimientos = CaProcedimiento::pluck('procedimiento','id')->all();
        return view('a_procedimientos.index', compact('aProcedimientos','aStArchivos','caProcedimientos'));
    }

    /**
     * Show the form for creating a new a procedimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caProcedimientos = CaProcedimiento::pluck('procedimiento','id')->all();
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
        $aStArchivos = AStArchivo::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('a_procedimientos.create', compact('caProcedimientos','bnds','empleados','aStArchivos','entities','users','users'));
    }

    /**
     * Store a new a procedimiento in the storage.
     *
     * @param App\Http\Requests\AProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            $data['st_archivo_id']=1;
            $data['archivo']="";
            AProcedimiento::create($data);

            return redirect()->route('a_procedimientos.a_procedimiento.index')
                             ->with('success_message', trans('a_procedimientos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_procedimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified a procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aProcedimiento = AProcedimiento::with('caprocedimiento','bnd','empleado','astarchivo','entity','user')->findOrFail($id);

        return view('a_procedimientos.show', compact('aProcedimiento'));
    }

    /**
     * Show the form for editing the specified a procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aProcedimiento = AProcedimiento::findOrFail($id);
        $caProcedimientos = CaProcedimiento::pluck('procedimiento','id')->all();
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
        $aStArchivos = AStArchivo::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('a_procedimientos.edit', compact('aProcedimiento','caProcedimientos','bnds','empleados','aStArchivos','entities','users','users'));
    }

    /**
     * Update the specified a procedimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aProcedimiento = AProcedimiento::findOrFail($id);
            $data['usu_mod_id']=Auth::user()->id;
            
            $aProcedimiento->update($data);

            return redirect()->route('a_procedimientos.a_procedimiento.index')
                             ->with('success_message', trans('a_procedimientos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_procedimientos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a procedimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aProcedimiento = AProcedimiento::findOrFail($id);
            $aProcedimiento->delete();

            return redirect()->route('a_procedimientos.a_procedimiento.index')
                             ->with('success_message', trans('a_procedimientos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_procedimientos.unexpected_error')]);
        }
    }



}
