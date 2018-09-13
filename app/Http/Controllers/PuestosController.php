<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Puesto;
use App\Http\Controllers\Controller;
use App\Http\Requests\PuestosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class PuestosController extends Controller
{

    /**
     * Display a listing of the puestos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
                
		$r=Puesto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['puesto']) and $input['puesto']<>null){
			$r->where('puesto', 'like', '%'.$input['puesto'].'%');
		}
                if (Auth::user()->canDo('filtro_entity')) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$puestos = $r->with('user')->paginate(25);
		//$puestos = Puesto::with('user')->paginate(25);

        return view('puestos.index', compact('puestos'));
    }

    /**
     * Show the form for creating a new puesto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('puestos.create', compact('users','users'));
    }

    /**
     * Store a new puesto in the storage.
     *
     * @param App\Http\Requests\PuestosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(PuestosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $data['usu_alta_id']=Auth::user()->id;
            $data['usu_mod_id']=Auth::user()->id;
            Puesto::create($data);

            return redirect()->route('puestos.puesto.index')
                             ->with('success_message', trans('puestos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('puestos.unexpected_error')]);
        }
    }

    /**
     * Display the specified puesto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $puesto = Puesto::with('user')->findOrFail($id);

        return view('puestos.show', compact('puesto'));
    }

    /**
     * Show the form for editing the specified puesto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $puesto = Puesto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('puestos.edit', compact('puesto','users','users'));
    }

    /**
     * Update the specified puesto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\PuestosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, PuestosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $data['usu_alta_id']=Auth::user()->id;
            $puesto = Puesto::findOrFail($id);
            $puesto->update($data);

            return redirect()->route('puestos.puesto.index')
                             ->with('success_message', trans('puestos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('puestos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified puesto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $puesto = Puesto::findOrFail($id);
            $puesto->delete();

            return redirect()->route('puestos.puesto.index')
                             ->with('success_message', trans('puestos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('puestos.unexpected_error')]);
        }
    }



}
