<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmisionEfecto;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmisionEfectosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class EmisionEfectosController extends Controller
{

    /**
     * Display a listing of the emision efectos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=EmisionEfecto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$emisionEfectos = $r->with('user')->paginate(25);
		//$emisionEfectos = EmisionEfecto::with('user')->paginate(25);

        return view('emision_efectos.index', compact('emisionEfectos'));
    }

    /**
     * Show the form for creating a new emision efecto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('emision_efectos.create', compact('users','users'));
    }

    /**
     * Store a new emision efecto in the storage.
     *
     * @param App\Http\Requests\EmisionEfectosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EmisionEfectosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            EmisionEfecto::create($data);

            return redirect()->route('emision_efectos.emision_efecto.index')
                             ->with('success_message', trans('emision_efectos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('emision_efectos.unexpected_error')]);
        }
    }

    /**
     * Display the specified emision efecto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $emisionEfecto = EmisionEfecto::with('user')->findOrFail($id);

        return view('emision_efectos.show', compact('emisionEfecto'));
    }

    /**
     * Show the form for editing the specified emision efecto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $emisionEfecto = EmisionEfecto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('emision_efectos.edit', compact('emisionEfecto','users','users'));
    }

    /**
     * Update the specified emision efecto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EmisionEfectosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EmisionEfectosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $emisionEfecto = EmisionEfecto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $emisionEfecto->update($data);

            return redirect()->route('emision_efectos.emision_efecto.index')
                             ->with('success_message', trans('emision_efectos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('emision_efectos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified emision efecto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $emisionEfecto = EmisionEfecto::findOrFail($id);
            $emisionEfecto->delete();

            return redirect()->route('emision_efectos.emision_efecto.index')
                             ->with('success_message', trans('emision_efectos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('emision_efectos.unexpected_error')]);
        }
    }



}
