<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaResiduo;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaResiduosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaResiduosController extends Controller
{

    /**
     * Display a listing of the ca residuos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaResiduo::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['residuo']) and $input['residuo']<>""){
			$r->where('residuo', 'like', '%'.$input['residuo'].'%');
		}
		$caResiduos = $r->with('user')->paginate(25);
		//$caResiduos = CaResiduo::with('user')->paginate(25);

        return view('ca_residuos.index', compact('caResiduos'));
    }

    /**
     * Show the form for creating a new ca residuo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('ca_residuos.create', compact('users','users'));
    }

    /**
     * Store a new ca residuo in the storage.
     *
     * @param App\Http\Requests\CaResiduosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaResiduosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaResiduo::create($data);

            return redirect()->route('ca_residuos.ca_residuo.index')
                             ->with('success_message', trans('ca_residuos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_residuos.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca residuo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caResiduo = CaResiduo::with('user')->findOrFail($id);

        return view('ca_residuos.show', compact('caResiduo'));
    }

    /**
     * Show the form for editing the specified ca residuo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caResiduo = CaResiduo::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('ca_residuos.edit', compact('caResiduo','users','users'));
    }

    /**
     * Update the specified ca residuo in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaResiduosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaResiduosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caResiduo = CaResiduo::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caResiduo->update($data);

            return redirect()->route('ca_residuos.ca_residuo.index')
                             ->with('success_message', trans('ca_residuos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_residuos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca residuo from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caResiduo = CaResiduo::findOrFail($id);
            $caResiduo->delete();

            return redirect()->route('ca_residuos.ca_residuo.index')
                             ->with('success_message', trans('ca_residuos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_residuos.unexpected_error')]);
        }
    }



}
