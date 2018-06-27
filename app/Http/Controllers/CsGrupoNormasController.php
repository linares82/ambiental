<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsGrupoNorma;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsGrupoNormasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsGrupoNormasController extends Controller
{

    /**
     * Display a listing of the cs grupo normas.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsGrupoNorma::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$csGrupoNormas = $r->with('user')->paginate(25);
		//$csGrupoNormas = CsGrupoNorma::with('user')->paginate(25);

        return view('cs_grupo_normas.index', compact('csGrupoNormas'));
    }

    /**
     * Show the form for creating a new cs grupo norma.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('cs_grupo_normas.create', compact('users','users'));
    }

    /**
     * Store a new cs grupo norma in the storage.
     *
     * @param App\Http\Requests\CsGrupoNormasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsGrupoNormasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsGrupoNorma::create($data);

            return redirect()->route('cs_grupo_normas.cs_grupo_norma.index')
                             ->with('success_message', trans('cs_grupo_normas.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_grupo_normas.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs grupo norma.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csGrupoNorma = CsGrupoNorma::with('user')->findOrFail($id);

        return view('cs_grupo_normas.show', compact('csGrupoNorma'));
    }

    /**
     * Show the form for editing the specified cs grupo norma.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csGrupoNorma = CsGrupoNorma::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('cs_grupo_normas.edit', compact('csGrupoNorma','users','users'));
    }

    /**
     * Update the specified cs grupo norma in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsGrupoNormasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsGrupoNormasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csGrupoNorma = CsGrupoNorma::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csGrupoNorma->update($data);

            return redirect()->route('cs_grupo_normas.cs_grupo_norma.index')
                             ->with('success_message', trans('cs_grupo_normas.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_grupo_normas.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs grupo norma from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csGrupoNorma = CsGrupoNorma::findOrFail($id);
            $csGrupoNorma->delete();

            return redirect()->route('cs_grupo_normas.cs_grupo_norma.index')
                             ->with('success_message', trans('cs_grupo_normas.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_grupo_normas.unexpected_error')]);
        }
    }



}
