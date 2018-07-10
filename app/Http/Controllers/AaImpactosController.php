<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AaImpacto;
use App\Http\Controllers\Controller;
use App\Http\Requests\AaImpactosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AaImpactosController extends Controller
{

    /**
     * Display a listing of the aa impactos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AaImpacto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['impacto']) and $input['impacto']<>null){
			$r->where('impacto', 'like', '%'.$input['impacto'].'%');
		}
		$aaImpactos = $r->with('user')->paginate(25);
		//$aaImpactos = AaImpacto::with('user')->paginate(25);

        return view('aa_impactos.index', compact('aaImpactos'));
    }

    /**
     * Show the form for creating a new aa impacto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('aa_impactos.create', compact('users','users'));
    }

    /**
     * Store a new aa impacto in the storage.
     *
     * @param App\Http\Requests\AaImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AaImpactosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AaImpacto::create($data);

            return redirect()->route('aa_impactos.aa_impacto.index')
                             ->with('success_message', trans('aa_impactos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_impactos.unexpected_error')]);
        }
    }

    /**
     * Display the specified aa impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aaImpacto = AaImpacto::with('user')->findOrFail($id);

        return view('aa_impactos.show', compact('aaImpacto'));
    }

    /**
     * Show the form for editing the specified aa impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aaImpacto = AaImpacto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('aa_impactos.edit', compact('aaImpacto','users','users'));
    }

    /**
     * Update the specified aa impacto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AaImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AaImpactosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aaImpacto = AaImpacto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aaImpacto->update($data);

            return redirect()->route('aa_impactos.aa_impacto.index')
                             ->with('success_message', trans('aa_impactos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_impactos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified aa impacto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aaImpacto = AaImpacto::findOrFail($id);
            $aaImpacto->delete();

            return redirect()->route('aa_impactos.aa_impacto.index')
                             ->with('success_message', trans('aa_impactos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_impactos.unexpected_error')]);
        }
    }



}
