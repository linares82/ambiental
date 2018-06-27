<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\SEstatusProcedimiento;
use App\Http\Requests\SEstatusProcedimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class SEstatusProcedimientosController extends Controller
{

    /**
     * Display a listing of the s estatus procedimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=SEstatusProcedimiento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$sEstatusProcedimientos = $r->with('user')->paginate(25);
		//$sEstatusProcedimientos = SEstatusProcedimiento::with('user')->paginate(25);

        return view('s_estatus_procedimientos.index', compact('sEstatusProcedimientos'));
    }

    /**
     * Show the form for creating a new s estatus procedimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('s_estatus_procedimientos.create', compact('users','users'));
    }

    /**
     * Store a new s estatus procedimiento in the storage.
     *
     * @param App\Http\Requests\SEstatusProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SEstatusProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            SEstatusProcedimiento::create($data);

            return redirect()->route('s_estatus_procedimientos.s_estatus_procedimiento.index')
                             ->with('success_message', trans('s_estatus_procedimientos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_estatus_procedimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified s estatus procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $sEstatusProcedimiento = SEstatusProcedimiento::with('user')->findOrFail($id);

        return view('s_estatus_procedimientos.show', compact('sEstatusProcedimiento'));
    }

    /**
     * Show the form for editing the specified s estatus procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sEstatusProcedimiento = SEstatusProcedimiento::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('s_estatus_procedimientos.edit', compact('sEstatusProcedimiento','users','users'));
    }

    /**
     * Update the specified s estatus procedimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SEstatusProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SEstatusProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $sEstatusProcedimiento = SEstatusProcedimiento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $sEstatusProcedimiento->update($data);

            return redirect()->route('s_estatus_procedimientos.s_estatus_procedimiento.index')
                             ->with('success_message', trans('s_estatus_procedimientos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_estatus_procedimientos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified s estatus procedimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sEstatusProcedimiento = SEstatusProcedimiento::findOrFail($id);
            $sEstatusProcedimiento->delete();

            return redirect()->route('s_estatus_procedimientos.s_estatus_procedimiento.index')
                             ->with('success_message', trans('s_estatus_procedimientos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_estatus_procedimientos.unexpected_error')]);
        }
    }



}
