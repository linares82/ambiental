<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsTpoDeteccion;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsTpoDeteccionsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsTpoDeteccionsController extends Controller
{

    /**
     * Display a listing of the cs tpo deteccions.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsTpoDeteccion::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$csTpoDeteccions = $r->with('user')->paginate(25);
		//$csTpoDeteccions = CsTpoDeteccion::with('user')->paginate(25);

        return view('cs_tpo_deteccions.index', compact('csTpoDeteccions'));
    }

    /**
     * Show the form for creating a new cs tpo deteccion.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('cs_tpo_deteccions.create', compact('users','users'));
    }

    /**
     * Store a new cs tpo deteccion in the storage.
     *
     * @param App\Http\Requests\CsTpoDeteccionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsTpoDeteccionsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsTpoDeteccion::create($data);

            return redirect()->route('cs_tpo_deteccions.cs_tpo_deteccion.index')
                             ->with('success_message', trans('cs_tpo_deteccions.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_deteccions.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs tpo deteccion.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csTpoDeteccion = CsTpoDeteccion::with('user')->findOrFail($id);

        return view('cs_tpo_deteccions.show', compact('csTpoDeteccion'));
    }

    /**
     * Show the form for editing the specified cs tpo deteccion.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csTpoDeteccion = CsTpoDeteccion::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('cs_tpo_deteccions.edit', compact('csTpoDeteccion','users','users'));
    }

    /**
     * Update the specified cs tpo deteccion in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsTpoDeteccionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsTpoDeteccionsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csTpoDeteccion = CsTpoDeteccion::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csTpoDeteccion->update($data);

            return redirect()->route('cs_tpo_deteccions.cs_tpo_deteccion.index')
                             ->with('success_message', trans('cs_tpo_deteccions.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_deteccions.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs tpo deteccion from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csTpoDeteccion = CsTpoDeteccion::findOrFail($id);
            $csTpoDeteccion->delete();

            return redirect()->route('cs_tpo_deteccions.cs_tpo_deteccion.index')
                             ->with('success_message', trans('cs_tpo_deteccions.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_deteccions.unexpected_error')]);
        }
    }



}
