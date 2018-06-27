<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsNorma;
use App\Models\CsGrupoNorma;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsNormasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsNormasController extends Controller
{

    /**
     * Display a listing of the cs normas.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsNorma::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$csNormas = $r->with('csgruponorma','user')->paginate(25);
		//$csNormas = CsNorma::with('csgruponorma','user')->paginate(25);

        return view('cs_normas.index', compact('csNormas'));
    }

    /**
     * Show the form for creating a new cs norma.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('cs_normas.create', compact('csGrupoNormas','users','users'));
    }

    /**
     * Store a new cs norma in the storage.
     *
     * @param App\Http\Requests\CsNormasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsNormasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsNorma::create($data);

            return redirect()->route('cs_normas.cs_norma.index')
                             ->with('success_message', trans('cs_normas.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_normas.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs norma.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csNorma = CsNorma::with('csgruponorma','user')->findOrFail($id);

        return view('cs_normas.show', compact('csNorma'));
    }

    /**
     * Show the form for editing the specified cs norma.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csNorma = CsNorma::findOrFail($id);
        $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
$users = User::pluck('name','id')->all();

        return view('cs_normas.edit', compact('csNorma','csGrupoNormas','users','users'));
    }

    /**
     * Update the specified cs norma in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsNormasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsNormasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csNorma = CsNorma::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csNorma->update($data);

            return redirect()->route('cs_normas.cs_norma.index')
                             ->with('success_message', trans('cs_normas.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_normas.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs norma from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csNorma = CsNorma::findOrFail($id);
            $csNorma->delete();

            return redirect()->route('cs_normas.cs_norma.index')
                             ->with('success_message', trans('cs_normas.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_normas.unexpected_error')]);
        }
    }



}
