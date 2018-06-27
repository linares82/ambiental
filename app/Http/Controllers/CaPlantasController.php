<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaPlanta;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaPlantasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaPlantasController extends Controller
{

    /**
     * Display a listing of the ca plantas.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaPlanta::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$caPlantas = $r->with('user')->paginate(25);
		//$caPlantas = CaPlanta::with('user')->paginate(25);

        return view('ca_plantas.index', compact('caPlantas'));
    }

    /**
     * Show the form for creating a new ca planta.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('ca_plantas.create', compact('users','users'));
    }

    /**
     * Store a new ca planta in the storage.
     *
     * @param App\Http\Requests\CaPlantasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaPlantasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaPlanta::create($data);

            return redirect()->route('ca_plantas.ca_planta.index')
                             ->with('success_message', trans('ca_plantas.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_plantas.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca planta.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caPlanta = CaPlanta::with('user')->findOrFail($id);

        return view('ca_plantas.show', compact('caPlanta'));
    }

    /**
     * Show the form for editing the specified ca planta.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caPlanta = CaPlanta::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('ca_plantas.edit', compact('caPlanta','users','users'));
    }

    /**
     * Update the specified ca planta in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaPlantasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaPlantasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caPlanta = CaPlanta::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caPlanta->update($data);

            return redirect()->route('ca_plantas.ca_planta.index')
                             ->with('success_message', trans('ca_plantas.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_plantas.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca planta from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caPlanta = CaPlanta::findOrFail($id);
            $caPlanta->delete();

            return redirect()->route('ca_plantas.ca_planta.index')
                             ->with('success_message', trans('ca_plantas.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_plantas.unexpected_error')]);
        }
    }



}
