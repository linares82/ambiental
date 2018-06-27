<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsAccidente;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsAccidentesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsAccidentesController extends Controller
{

    /**
     * Display a listing of the cs accidentes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsAccidente::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$csAccidentes = $r->with('user')->paginate(25);
		//$csAccidentes = CsAccidente::with('user')->paginate(25);

        return view('cs_accidentes.index', compact('csAccidentes'));
    }

    /**
     * Show the form for creating a new cs accidente.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('cs_accidentes.create', compact('users','users'));
    }

    /**
     * Store a new cs accidente in the storage.
     *
     * @param App\Http\Requests\CsAccidentesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsAccidentesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsAccidente::create($data);

            return redirect()->route('cs_accidentes.cs_accidente.index')
                             ->with('success_message', trans('cs_accidentes.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_accidentes.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs accidente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csAccidente = CsAccidente::with('user')->findOrFail($id);

        return view('cs_accidentes.show', compact('csAccidente'));
    }

    /**
     * Show the form for editing the specified cs accidente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csAccidente = CsAccidente::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('cs_accidentes.edit', compact('csAccidente','users','users'));
    }

    /**
     * Update the specified cs accidente in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsAccidentesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsAccidentesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csAccidente = CsAccidente::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csAccidente->update($data);

            return redirect()->route('cs_accidentes.cs_accidente.index')
                             ->with('success_message', trans('cs_accidentes.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_accidentes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs accidente from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csAccidente = CsAccidente::findOrFail($id);
            $csAccidente->delete();

            return redirect()->route('cs_accidentes.cs_accidente.index')
                             ->with('success_message', trans('cs_accidentes.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_accidentes.unexpected_error')]);
        }
    }



}
