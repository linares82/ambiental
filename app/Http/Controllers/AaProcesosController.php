<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AaProceso;
use App\Http\Controllers\Controller;
use App\Http\Requests\AaProcesosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AaProcesosController extends Controller
{

    /**
     * Display a listing of the aa procesos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AaProceso::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aaProcesos = $r->with('user')->paginate(25);
		//$aaProcesos = AaProceso::with('user')->paginate(25);

        return view('aa_procesos.index', compact('aaProcesos'));
    }

    /**
     * Show the form for creating a new aa proceso.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('aa_procesos.create', compact('users','users'));
    }

    /**
     * Store a new aa proceso in the storage.
     *
     * @param App\Http\Requests\AaProcesosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AaProcesosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AaProceso::create($data);

            return redirect()->route('aa_procesos.aa_proceso.index')
                             ->with('success_message', trans('aa_procesos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_procesos.unexpected_error')]);
        }
    }

    /**
     * Display the specified aa proceso.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aaProceso = AaProceso::with('user')->findOrFail($id);

        return view('aa_procesos.show', compact('aaProceso'));
    }

    /**
     * Show the form for editing the specified aa proceso.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aaProceso = AaProceso::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('aa_procesos.edit', compact('aaProceso','users','users'));
    }

    /**
     * Update the specified aa proceso in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AaProcesosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AaProcesosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aaProceso = AaProceso::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aaProceso->update($data);

            return redirect()->route('aa_procesos.aa_proceso.index')
                             ->with('success_message', trans('aa_procesos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_procesos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified aa proceso from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aaProceso = AaProceso::findOrFail($id);
            $aaProceso->delete();

            return redirect()->route('aa_procesos.aa_proceso.index')
                             ->with('success_message', trans('aa_procesos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_procesos.unexpected_error')]);
        }
    }



}
