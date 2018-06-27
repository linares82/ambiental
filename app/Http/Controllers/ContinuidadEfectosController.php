<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ContinuidadEfecto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContinuidadEfectosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ContinuidadEfectosController extends Controller
{

    /**
     * Display a listing of the continuidad efectos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=ContinuidadEfecto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$continuidadEfectos = $r->with('user')->paginate(25);
		//$continuidadEfectos = ContinuidadEfecto::with('user')->paginate(25);

        return view('continuidad_efectos.index', compact('continuidadEfectos'));
    }

    /**
     * Show the form for creating a new continuidad efecto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('continuidad_efectos.create', compact('users','users'));
    }

    /**
     * Store a new continuidad efecto in the storage.
     *
     * @param App\Http\Requests\ContinuidadEfectosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ContinuidadEfectosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            ContinuidadEfecto::create($data);

            return redirect()->route('continuidad_efectos.continuidad_efecto.index')
                             ->with('success_message', trans('continuidad_efectos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('continuidad_efectos.unexpected_error')]);
        }
    }

    /**
     * Display the specified continuidad efecto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $continuidadEfecto = ContinuidadEfecto::with('user')->findOrFail($id);

        return view('continuidad_efectos.show', compact('continuidadEfecto'));
    }

    /**
     * Show the form for editing the specified continuidad efecto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $continuidadEfecto = ContinuidadEfecto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('continuidad_efectos.edit', compact('continuidadEfecto','users','users'));
    }

    /**
     * Update the specified continuidad efecto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ContinuidadEfectosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ContinuidadEfectosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $continuidadEfecto = ContinuidadEfecto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $continuidadEfecto->update($data);

            return redirect()->route('continuidad_efectos.continuidad_efecto.index')
                             ->with('success_message', trans('continuidad_efectos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('continuidad_efectos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified continuidad efecto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $continuidadEfecto = ContinuidadEfecto::findOrFail($id);
            $continuidadEfecto->delete();

            return redirect()->route('continuidad_efectos.continuidad_efecto.index')
                             ->with('success_message', trans('continuidad_efectos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('continuidad_efectos.unexpected_error')]);
        }
    }



}
