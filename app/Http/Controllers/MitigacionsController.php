<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mitigacion;
use App\Http\Controllers\Controller;
use App\Http\Requests\MitigacionsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class MitigacionsController extends Controller
{

    /**
     * Display a listing of the mitigacions.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Mitigacion::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$mitigacions = $r->with('user')->paginate(25);
		//$mitigacions = Mitigacion::with('user')->paginate(25);

        return view('mitigacions.index', compact('mitigacions'));
    }

    /**
     * Show the form for creating a new mitigacion.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('mitigacions.create', compact('users','users'));
    }

    /**
     * Store a new mitigacion in the storage.
     *
     * @param App\Http\Requests\MitigacionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MitigacionsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Mitigacion::create($data);

            return redirect()->route('mitigacions.mitigacion.index')
                             ->with('success_message', trans('mitigacions.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('mitigacions.unexpected_error')]);
        }
    }

    /**
     * Display the specified mitigacion.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $mitigacion = Mitigacion::with('user')->findOrFail($id);

        return view('mitigacions.show', compact('mitigacion'));
    }

    /**
     * Show the form for editing the specified mitigacion.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $mitigacion = Mitigacion::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('mitigacions.edit', compact('mitigacion','users','users'));
    }

    /**
     * Update the specified mitigacion in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MitigacionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MitigacionsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $mitigacion = Mitigacion::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $mitigacion->update($data);

            return redirect()->route('mitigacions.mitigacion.index')
                             ->with('success_message', trans('mitigacions.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('mitigacions.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified mitigacion from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $mitigacion = Mitigacion::findOrFail($id);
            $mitigacion->delete();

            return redirect()->route('mitigacions.mitigacion.index')
                             ->with('success_message', trans('mitigacions.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('mitigacions.unexpected_error')]);
        }
    }



}
