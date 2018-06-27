<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaTpoBitacora;
use App\Models\CaTpoNoConformidad;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaTpoNoConformidadsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaTpoNoConformidadsController extends Controller
{

    /**
     * Display a listing of the ca tpo no conformidads.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaTpoNoConformidad::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$caTpoNoConformidads = $r->with('catpobitacora')->paginate(25);
		//$caTpoNoConformidads = CaTpoNoConformidad::with('catpobitacora')->paginate(25);

        return view('ca_tpo_no_conformidads.index', compact('caTpoNoConformidads'));
    }

    /**
     * Show the form for creating a new ca tpo no conformidad.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caTpoBitacoras = CaTpoBitacora::pluck('tpo_bitacora','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('ca_tpo_no_conformidads.create', compact('caTpoBitacoras','users','users'));
    }

    /**
     * Store a new ca tpo no conformidad in the storage.
     *
     * @param App\Http\Requests\CaTpoNoConformidadsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaTpoNoConformidadsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaTpoNoConformidad::create($data);

            return redirect()->route('ca_tpo_no_conformidads.ca_tpo_no_conformidad.index')
                             ->with('success_message', trans('ca_tpo_no_conformidads.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_tpo_no_conformidads.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca tpo no conformidad.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caTpoNoConformidad = CaTpoNoConformidad::with('catpobitacora','user')->findOrFail($id);

        return view('ca_tpo_no_conformidads.show', compact('caTpoNoConformidad'));
    }

    /**
     * Show the form for editing the specified ca tpo no conformidad.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caTpoNoConformidad = CaTpoNoConformidad::findOrFail($id);
        $caTpoBitacoras = CaTpoBitacora::pluck('tpo_bitacora','id')->all();
$users = User::pluck('name','id')->all();

        return view('ca_tpo_no_conformidads.edit', compact('caTpoNoConformidad','caTpoBitacoras','users','users'));
    }

    /**
     * Update the specified ca tpo no conformidad in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaTpoNoConformidadsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaTpoNoConformidadsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caTpoNoConformidad = CaTpoNoConformidad::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caTpoNoConformidad->update($data);

            return redirect()->route('ca_tpo_no_conformidads.ca_tpo_no_conformidad.index')
                             ->with('success_message', trans('ca_tpo_no_conformidads.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_tpo_no_conformidads.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca tpo no conformidad from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caTpoNoConformidad = CaTpoNoConformidad::findOrFail($id);
            $caTpoNoConformidad->delete();

            return redirect()->route('ca_tpo_no_conformidads.ca_tpo_no_conformidad.index')
                             ->with('success_message', trans('ca_tpo_no_conformidads.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_tpo_no_conformidads.unexpected_error')]);
        }
    }



}
