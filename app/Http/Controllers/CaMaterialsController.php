<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaMaterial;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaMaterialsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaMaterialsController extends Controller
{

    /**
     * Display a listing of the ca materials.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaMaterial::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['material']) and $input['material']<>""){
			$r->where('material', 'like', '%'.$input['material'].'%');
		}
		$caMaterials = $r->with('user')->paginate(25);
		//$caMaterials = CaMaterial::with('user')->paginate(25);

        return view('ca_materials.index', compact('caMaterials'));
    }

    /**
     * Show the form for creating a new ca material.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('ca_materials.create', compact('users','users'));
    }

    /**
     * Store a new ca material in the storage.
     *
     * @param App\Http\Requests\CaMaterialsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaMaterialsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaMaterial::create($data);

            return redirect()->route('ca_materials.ca_material.index')
                             ->with('success_message', trans('ca_materials.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_materials.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca material.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caMaterial = CaMaterial::with('user')->findOrFail($id);

        return view('ca_materials.show', compact('caMaterial'));
    }

    /**
     * Show the form for editing the specified ca material.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caMaterial = CaMaterial::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('ca_materials.edit', compact('caMaterial','users','users'));
    }

    /**
     * Update the specified ca material in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaMaterialsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaMaterialsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caMaterial = CaMaterial::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caMaterial->update($data);

            return redirect()->route('ca_materials.ca_material.index')
                             ->with('success_message', trans('ca_materials.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_materials.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca material from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caMaterial = CaMaterial::findOrFail($id);
            $caMaterial->delete();

            return redirect()->route('ca_materials.ca_material.index')
                             ->with('success_message', trans('ca_materials.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_materials.unexpected_error')]);
        }
    }



}
