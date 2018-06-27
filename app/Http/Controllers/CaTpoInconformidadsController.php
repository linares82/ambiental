<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaTpoInconformidad;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaTpoInconformidadsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaTpoInconformidadsController extends Controller
{

    /**
     * Display a listing of the ca tpo inconformidads.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaTpoInconformidad::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$caTpoInconformidads = $r->with('user')->paginate(25);
		//$caTpoInconformidads = CaTpoInconformidad::with('user')->paginate(25);

        return view('ca_tpo_inconformidads.index', compact('caTpoInconformidads'));
    }

    /**
     * Show the form for creating a new ca tpo inconformidad.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('ca_tpo_inconformidads.create', compact('users','users'));
    }

    /**
     * Store a new ca tpo inconformidad in the storage.
     *
     * @param App\Http\Requests\CaTpoInconformidadsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaTpoInconformidadsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaTpoInconformidad::create($data);

            return redirect()->route('ca_tpo_inconformidads.ca_tpo_inconformidad.index')
                             ->with('success_message', trans('ca_tpo_inconformidads.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_tpo_inconformidads.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca tpo inconformidad.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caTpoInconformidad = CaTpoInconformidad::with('user')->findOrFail($id);

        return view('ca_tpo_inconformidads.show', compact('caTpoInconformidad'));
    }

    /**
     * Show the form for editing the specified ca tpo inconformidad.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caTpoInconformidad = CaTpoInconformidad::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('ca_tpo_inconformidads.edit', compact('caTpoInconformidad','users','users'));
    }

    /**
     * Update the specified ca tpo inconformidad in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaTpoInconformidadsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaTpoInconformidadsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caTpoInconformidad = CaTpoInconformidad::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caTpoInconformidad->update($data);

            return redirect()->route('ca_tpo_inconformidads.ca_tpo_inconformidad.index')
                             ->with('success_message', trans('ca_tpo_inconformidads.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_tpo_inconformidads.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca tpo inconformidad from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caTpoInconformidad = CaTpoInconformidad::findOrFail($id);
            $caTpoInconformidad->delete();

            return redirect()->route('ca_tpo_inconformidads.ca_tpo_inconformidad.index')
                             ->with('success_message', trans('ca_tpo_inconformidads.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_tpo_inconformidads.unexpected_error')]);
        }
    }



}
