<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StRegImpacto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StRegImpactosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class StRegImpactosController extends Controller
{

    /**
     * Display a listing of the st reg impactos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=StRegImpacto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$stRegImpactos = $r->with('user')->paginate(25);
		//$stRegImpactos = StRegImpacto::with('user')->paginate(25);

        return view('st_reg_impactos.index', compact('stRegImpactos'));
    }

    /**
     * Show the form for creating a new st reg impacto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('st_reg_impactos.create', compact('users','users'));
    }

    /**
     * Store a new st reg impacto in the storage.
     *
     * @param App\Http\Requests\StRegImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(StRegImpactosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            StRegImpacto::create($data);

            return redirect()->route('st_reg_impactos.st_reg_impacto.index')
                             ->with('success_message', trans('st_reg_impactos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('st_reg_impactos.unexpected_error')]);
        }
    }

    /**
     * Display the specified st reg impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $stRegImpacto = StRegImpacto::with('user')->findOrFail($id);

        return view('st_reg_impactos.show', compact('stRegImpacto'));
    }

    /**
     * Show the form for editing the specified st reg impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $stRegImpacto = StRegImpacto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('st_reg_impactos.edit', compact('stRegImpacto','users','users'));
    }

    /**
     * Update the specified st reg impacto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\StRegImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, StRegImpactosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $stRegImpacto = StRegImpacto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $stRegImpacto->update($data);

            return redirect()->route('st_reg_impactos.st_reg_impacto.index')
                             ->with('success_message', trans('st_reg_impactos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('st_reg_impactos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified st reg impacto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $stRegImpacto = StRegImpacto::findOrFail($id);
            $stRegImpacto->delete();

            return redirect()->route('st_reg_impactos.st_reg_impacto.index')
                             ->with('success_message', trans('st_reg_impactos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('st_reg_impactos.unexpected_error')]);
        }
    }



}
