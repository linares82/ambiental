<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TipoImpacto;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoImpactosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class TipoImpactosController extends Controller
{

    /**
     * Display a listing of the tipo impactos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=TipoImpacto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$tipoImpactos = $r->with('user')->paginate(25);
		//$tipoImpactos = TipoImpacto::with('user')->paginate(25);

        return view('tipo_impactos.index', compact('tipoImpactos'));
    }

    /**
     * Show the form for creating a new tipo impacto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('tipo_impactos.create', compact('users','users'));
    }

    /**
     * Store a new tipo impacto in the storage.
     *
     * @param App\Http\Requests\TipoImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(TipoImpactosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            TipoImpacto::create($data);

            return redirect()->route('tipo_impactos.tipo_impacto.index')
                             ->with('success_message', trans('tipo_impactos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tipo_impactos.unexpected_error')]);
        }
    }

    /**
     * Display the specified tipo impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $tipoImpacto = TipoImpacto::with('user')->findOrFail($id);

        return view('tipo_impactos.show', compact('tipoImpacto'));
    }

    /**
     * Show the form for editing the specified tipo impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $tipoImpacto = TipoImpacto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('tipo_impactos.edit', compact('tipoImpacto','users','users'));
    }

    /**
     * Update the specified tipo impacto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\TipoImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, TipoImpactosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $tipoImpacto = TipoImpacto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $tipoImpacto->update($data);

            return redirect()->route('tipo_impactos.tipo_impacto.index')
                             ->with('success_message', trans('tipo_impactos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tipo_impactos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified tipo impacto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $tipoImpacto = TipoImpacto::findOrFail($id);
            $tipoImpacto->delete();

            return redirect()->route('tipo_impactos.tipo_impacto.index')
                             ->with('success_message', trans('tipo_impactos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tipo_impactos.unexpected_error')]);
        }
    }



}
