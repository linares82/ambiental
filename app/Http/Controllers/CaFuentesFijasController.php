<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaFuentesFija;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaFuentesFijasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaFuentesFijasController extends Controller
{

    /**
     * Display a listing of the ca fuentes fijas.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaFuentesFija::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['planta']) and $input['planta']<>""){
			$r->where('planta', 'like', '%'.$input['planta'].'%');
		}
                if(isset($input['marca']) and $input['marca']<>""){
			$r->where('marca', 'like', '%'.$input['marca'].'%');
		}
		$caFuentesFijas = $r->with('user')->paginate(25);
		//$caFuentesFijas = CaFuentesFija::with('user')->paginate(25);

        return view('ca_fuentes_fijas.index', compact('caFuentesFijas'));
    }

    /**
     * Show the form for creating a new ca fuentes fija.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('ca_fuentes_fijas.create', compact('users','users'));
    }

    /**
     * Store a new ca fuentes fija in the storage.
     *
     * @param App\Http\Requests\CaFuentesFijasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaFuentesFijasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaFuentesFija::create($data);

            return redirect()->route('ca_fuentes_fijas.ca_fuentes_fija.index')
                             ->with('success_message', trans('ca_fuentes_fijas.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_fuentes_fijas.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca fuentes fija.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caFuentesFija = CaFuentesFija::with('user')->findOrFail($id);

        return view('ca_fuentes_fijas.show', compact('caFuentesFija'));
    }

    /**
     * Show the form for editing the specified ca fuentes fija.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caFuentesFija = CaFuentesFija::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('ca_fuentes_fijas.edit', compact('caFuentesFija','users','users'));
    }

    /**
     * Update the specified ca fuentes fija in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaFuentesFijasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaFuentesFijasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caFuentesFija = CaFuentesFija::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caFuentesFija->update($data);

            return redirect()->route('ca_fuentes_fijas.ca_fuentes_fija.index')
                             ->with('success_message', trans('ca_fuentes_fijas.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_fuentes_fijas.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca fuentes fija from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caFuentesFija = CaFuentesFija::findOrFail($id);
            $caFuentesFija->delete();

            return redirect()->route('ca_fuentes_fijas.ca_fuentes_fija.index')
                             ->with('success_message', trans('ca_fuentes_fijas.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_fuentes_fijas.unexpected_error')]);
        }
    }



}
