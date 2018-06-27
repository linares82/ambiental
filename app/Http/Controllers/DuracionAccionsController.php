<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DuracionAccion;
use App\Http\Controllers\Controller;
use App\Http\Requests\DuracionAccionsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class DuracionAccionsController extends Controller
{

    /**
     * Display a listing of the duracion accions.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=DuracionAccion::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$duracionAccions = $r->with('user')->paginate(25);
		//$duracionAccions = DuracionAccion::with('user')->paginate(25);

        return view('duracion_accions.index', compact('duracionAccions'));
    }

    /**
     * Show the form for creating a new duracion accion.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('duracion_accions.create', compact('users','users'));
    }

    /**
     * Store a new duracion accion in the storage.
     *
     * @param App\Http\Requests\DuracionAccionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(DuracionAccionsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            DuracionAccion::create($data);

            return redirect()->route('duracion_accions.duracion_accion.index')
                             ->with('success_message', trans('duracion_accions.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('duracion_accions.unexpected_error')]);
        }
    }

    /**
     * Display the specified duracion accion.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $duracionAccion = DuracionAccion::with('user')->findOrFail($id);

        return view('duracion_accions.show', compact('duracionAccion'));
    }

    /**
     * Show the form for editing the specified duracion accion.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $duracionAccion = DuracionAccion::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('duracion_accions.edit', compact('duracionAccion','users','users'));
    }

    /**
     * Update the specified duracion accion in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\DuracionAccionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, DuracionAccionsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $duracionAccion = DuracionAccion::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $duracionAccion->update($data);

            return redirect()->route('duracion_accions.duracion_accion.index')
                             ->with('success_message', trans('duracion_accions.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('duracion_accions.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified duracion accion from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $duracionAccion = DuracionAccion::findOrFail($id);
            $duracionAccion->delete();

            return redirect()->route('duracion_accions.duracion_accion.index')
                             ->with('success_message', trans('duracion_accions.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('duracion_accions.unexpected_error')]);
        }
    }



}
