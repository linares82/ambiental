<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\IntensidadImpacto;
use App\Http\Controllers\Controller;
use App\Http\Requests\IntensidadImpactosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class IntensidadImpactosController extends Controller
{

    /**
     * Display a listing of the intensidad impactos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=IntensidadImpacto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$intensidadImpactos = $r->with('user')->paginate(25);
		//$intensidadImpactos = IntensidadImpacto::with('user')->paginate(25);

        return view('intensidad_impactos.index', compact('intensidadImpactos'));
    }

    /**
     * Show the form for creating a new intensidad impacto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('intensidad_impactos.create', compact('users','users'));
    }

    /**
     * Store a new intensidad impacto in the storage.
     *
     * @param App\Http\Requests\IntensidadImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(IntensidadImpactosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            IntensidadImpacto::create($data);

            return redirect()->route('intensidad_impactos.intensidad_impacto.index')
                             ->with('success_message', trans('intensidad_impactos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('intensidad_impactos.unexpected_error')]);
        }
    }

    /**
     * Display the specified intensidad impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $intensidadImpacto = IntensidadImpacto::with('user')->findOrFail($id);

        return view('intensidad_impactos.show', compact('intensidadImpacto'));
    }

    /**
     * Show the form for editing the specified intensidad impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $intensidadImpacto = IntensidadImpacto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('intensidad_impactos.edit', compact('intensidadImpacto','users','users'));
    }

    /**
     * Update the specified intensidad impacto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\IntensidadImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, IntensidadImpactosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $intensidadImpacto = IntensidadImpacto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $intensidadImpacto->update($data);

            return redirect()->route('intensidad_impactos.intensidad_impacto.index')
                             ->with('success_message', trans('intensidad_impactos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('intensidad_impactos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified intensidad impacto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $intensidadImpacto = IntensidadImpacto::findOrFail($id);
            $intensidadImpacto->delete();

            return redirect()->route('intensidad_impactos.intensidad_impacto.index')
                             ->with('success_message', trans('intensidad_impactos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('intensidad_impactos.unexpected_error')]);
        }
    }



}
