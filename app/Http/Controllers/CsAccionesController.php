<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsAccione;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsAccionesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsAccionesController extends Controller
{

    /**
     * Display a listing of the cs acciones.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsAccione::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['accion']) and $input['accion']<>null){
			$r->where('accion', 'like', '%'.$input['accion'].'%');
		}
		$csAcciones = $r->with('user')->paginate(25);
		//$csAcciones = CsAccione::with('user')->paginate(25);

        return view('cs_acciones.index', compact('csAcciones'));
    }

    /**
     * Show the form for creating a new cs accione.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('cs_acciones.create', compact('users','users'));
    }

    /**
     * Store a new cs accione in the storage.
     *
     * @param App\Http\Requests\CsAccionesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsAccionesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsAccione::create($data);

            return redirect()->route('cs_acciones.cs_accione.index')
                             ->with('success_message', trans('cs_acciones.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_acciones.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs accione.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csAccione = CsAccione::with('user')->findOrFail($id);

        return view('cs_acciones.show', compact('csAccione'));
    }

    /**
     * Show the form for editing the specified cs accione.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csAccione = CsAccione::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('cs_acciones.edit', compact('csAccione','users','users'));
    }

    /**
     * Update the specified cs accione in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsAccionesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsAccionesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csAccione = CsAccione::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csAccione->update($data);

            return redirect()->route('cs_acciones.cs_accione.index')
                             ->with('success_message', trans('cs_acciones.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_acciones.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs accione from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csAccione = CsAccione::findOrFail($id);
            $csAccione->delete();

            return redirect()->route('cs_acciones.cs_accione.index')
                             ->with('success_message', trans('cs_acciones.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_acciones.unexpected_error')]);
        }
    }



}
