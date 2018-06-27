<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Caracteristica;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaracteristicasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaracteristicasController extends Controller
{

    /**
     * Display a listing of the caracteristicas.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Caracteristica::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$caracteristicas = $r->with('user')->paginate(25);
		//$caracteristicas = Caracteristica::with('user')->paginate(25);

        return view('caracteristicas.index', compact('caracteristicas'));
    }

    /**
     * Show the form for creating a new caracteristica.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('caracteristicas.create', compact('users','users'));
    }

    /**
     * Store a new caracteristica in the storage.
     *
     * @param App\Http\Requests\CaracteristicasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaracteristicasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Caracteristica::create($data);

            return redirect()->route('caracteristicas.caracteristica.index')
                             ->with('success_message', trans('caracteristicas.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('caracteristicas.unexpected_error')]);
        }
    }

    /**
     * Display the specified caracteristica.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caracteristica = Caracteristica::with('user')->findOrFail($id);

        return view('caracteristicas.show', compact('caracteristica'));
    }

    /**
     * Show the form for editing the specified caracteristica.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caracteristica = Caracteristica::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('caracteristicas.edit', compact('caracteristica','users','users'));
    }

    /**
     * Update the specified caracteristica in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaracteristicasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaracteristicasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caracteristica = Caracteristica::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caracteristica->update($data);

            return redirect()->route('caracteristicas.caracteristica.index')
                             ->with('success_message', trans('caracteristicas.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('caracteristicas.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified caracteristica from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caracteristica = Caracteristica::findOrFail($id);
            $caracteristica->delete();

            return redirect()->route('caracteristicas.caracteristica.index')
                             ->with('success_message', trans('caracteristicas.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('caracteristicas.unexpected_error')]);
        }
    }



}
