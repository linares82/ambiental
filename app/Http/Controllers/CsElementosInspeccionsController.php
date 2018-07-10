<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsNorma;
use App\Models\CsGrupoNorma;
use App\Http\Controllers\Controller;
use App\Models\CsElementosInspeccion;
use App\Http\Requests\CsElementosInspeccionsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsElementosInspeccionsController extends Controller
{

    /**
     * Display a listing of the cs elementos inspeccions.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsElementosInspeccion::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['grupo_norma_id']) and $input['grupo_norma_id']<>null){
			$r->where('grupo_norma_id', '=', $input['grupo_norma_id']);
		}
                if(isset($input['norma_id']) and $input['norma_id']<>null){
			$r->where('norma_id', '=', $input['norma_id']);
		}
		if(isset($input['elemento']) and $input['elemento']<>""){
			$r->where('elemento', 'like', '%'.$input['elemento'].'%');
		}
                $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
                $csNormas = CsNorma::pluck('norma','id')->all();
		$csElementosInspeccions = $r->with('csgruponorma','csnorma','user')->paginate(25);
		//$csElementosInspeccions = CsElementosInspeccion::with('csgruponorma','csnorma','user')->paginate(25);

        return view('cs_elementos_inspeccions.index', compact('csElementosInspeccions','csGrupoNormas','csNormas'));
    }

    /**
     * Show the form for creating a new cs elementos inspeccion.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
$csNormas = CsNorma::pluck('norma','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('cs_elementos_inspeccions.create', compact('csGrupoNormas','csNormas','users','users'));
    }

    /**
     * Store a new cs elementos inspeccion in the storage.
     *
     * @param App\Http\Requests\CsElementosInspeccionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsElementosInspeccionsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsElementosInspeccion::create($data);

            return redirect()->route('cs_elementos_inspeccions.cs_elementos_inspeccion.index')
                             ->with('success_message', trans('cs_elementos_inspeccions.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_elementos_inspeccions.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs elementos inspeccion.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csElementosInspeccion = CsElementosInspeccion::with('csgruponorma','csnorma','user')->findOrFail($id);

        return view('cs_elementos_inspeccions.show', compact('csElementosInspeccion'));
    }

    /**
     * Show the form for editing the specified cs elementos inspeccion.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csElementosInspeccion = CsElementosInspeccion::findOrFail($id);
        $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
$csNormas = CsNorma::pluck('norma','id')->all();
$users = User::pluck('name','id')->all();

        return view('cs_elementos_inspeccions.edit', compact('csElementosInspeccion','csGrupoNormas','csNormas','users','users'));
    }

    /**
     * Update the specified cs elementos inspeccion in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsElementosInspeccionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsElementosInspeccionsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csElementosInspeccion = CsElementosInspeccion::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csElementosInspeccion->update($data);

            return redirect()->route('cs_elementos_inspeccions.cs_elementos_inspeccion.index')
                             ->with('success_message', trans('cs_elementos_inspeccions.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_elementos_inspeccions.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs elementos inspeccion from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csElementosInspeccion = CsElementosInspeccion::findOrFail($id);
            $csElementosInspeccion->delete();

            return redirect()->route('cs_elementos_inspeccions.cs_elementos_inspeccion.index')
                             ->with('success_message', trans('cs_elementos_inspeccions.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_elementos_inspeccions.unexpected_error')]);
        }
    }



}
