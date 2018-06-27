<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\CsTpoDoc;
use App\Models\Empleado;
use App\Models\SProcedimiento;
use App\Models\CsTpoProcedimiento;
use App\Http\Controllers\Controller;
use App\Models\SEstatusProcedimiento;
use App\Http\Requests\SProcedimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class SProcedimientosController extends Controller
{

    /**
     * Display a listing of the s procedimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=SProcedimiento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$sProcedimientos = $r->with('cstpoprocedimiento','cstpodoc','bnd','empleado','sestatusprocedimiento','entity','user')->paginate(25);
		//$sProcedimientos = SProcedimiento::with('cstpoprocedimiento','cstpodoc','bnd','empleado','sestatusprocedimiento','entity','user')->paginate(25);
                $sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
        return view('s_procedimientos.index', compact('sProcedimientos','sEstatusProcedimientos'));
    }

    /**
     * Show the form for creating a new s procedimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $csTpoProcedimientos = CsTpoProcedimiento::pluck('tpo_procedimiento','id')->all();
        $csTpoDocs = CsTpoDoc::pluck('tpo_doc','id')->all();
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('s_procedimientos.create', compact('csTpoProcedimientos','csTpoDocs','bnds','empleados','sEstatusProcedimientos','entities','users','users'));
    }

    /**
     * Store a new s procedimiento in the storage.
     *
     * @param App\Http\Requests\SProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
	    $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            $data['estatus_id']=1;
            SProcedimiento::create($data);

            return redirect()->route('s_procedimientos.s_procedimiento.index')
                             ->with('success_message', trans('s_procedimientos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_procedimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified s procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $sProcedimiento = SProcedimiento::with('cstpoprocedimiento','cstpodoc','bnd','empleado','sestatusprocedimiento','entity','user')->findOrFail($id);

        return view('s_procedimientos.show', compact('sProcedimiento'));
    }

    /**
     * Show the form for editing the specified s procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sProcedimiento = SProcedimiento::findOrFail($id);
        $csTpoProcedimientos = CsTpoProcedimiento::pluck('tpo_procedimiento','id')->all();
        $csTpoDocs = CsTpoDoc::pluck('tpo_doc','id')->all();
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('s_procedimientos.edit', compact('sProcedimiento','csTpoProcedimientos','csTpoDocs','bnds','empleados','sEstatusProcedimientos','entities','users','users'));
    }

    /**
     * Update the specified s procedimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $sProcedimiento = SProcedimiento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $sProcedimiento->update($data);

            return redirect()->route('s_procedimientos.s_procedimiento.index')
                             ->with('success_message', trans('s_procedimientos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_procedimientos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified s procedimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sProcedimiento = SProcedimiento::findOrFail($id);
            $sProcedimiento->delete();

            return redirect()->route('s_procedimientos.s_procedimiento.index')
                             ->with('success_message', trans('s_procedimientos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_procedimientos.unexpected_error')]);
        }
    }



}
