<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Turno;
use App\Http\Controllers\Controller;
use App\Http\Requests\TurnosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class TurnosController extends Controller
{

    /**
     * Display a listing of the turnos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Turno::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$turnos = $r->with('user')->paginate(25);
		//$turnos = Turno::with('user')->paginate(25);

        return view('turnos.index', compact('turnos'));
    }

    /**
     * Show the form for creating a new turno.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('turnos.create', compact('users','users'));
    }

    /**
     * Store a new turno in the storage.
     *
     * @param App\Http\Requests\TurnosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(TurnosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Turno::create($data);

            return redirect()->route('turnos.turno.index')
                             ->with('success_message', trans('turnos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('turnos.unexpected_error')]);
        }
    }

    /**
     * Display the specified turno.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $turno = Turno::with('user')->findOrFail($id);

        return view('turnos.show', compact('turno'));
    }

    /**
     * Show the form for editing the specified turno.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $turno = Turno::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('turnos.edit', compact('turno','users','users'));
    }

    /**
     * Update the specified turno in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\TurnosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, TurnosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $turno = Turno::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $turno->update($data);

            return redirect()->route('turnos.turno.index')
                             ->with('success_message', trans('turnos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('turnos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified turno from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $turno = Turno::findOrFail($id);
            $turno->delete();

            return redirect()->route('turnos.turno.index')
                             ->with('success_message', trans('turnos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('turnos.unexpected_error')]);
        }
    }



}
