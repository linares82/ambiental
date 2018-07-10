<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Especifico;
use App\Http\Controllers\Controller;
use App\Http\Requests\EspecificosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class EspecificosController extends Controller
{

    /**
     * Display a listing of the especificos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Especifico::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['especifico']) and $input['especifico']<>null){
			$r->where('especifico', 'like', '%'.$input['especifico'].'%');
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$especificos = $r->with('user')->paginate(25);
		//$especificos = Especifico::with('user')->paginate(25);

        return view('especificos.index', compact('especificos'));
    }

    /**
     * Show the form for creating a new especifico.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('especificos.create', compact('users','users'));
    }

    /**
     * Store a new especifico in the storage.
     *
     * @param App\Http\Requests\EspecificosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EspecificosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Especifico::create($data);

            return redirect()->route('especificos.especifico.index')
                             ->with('success_message', trans('especificos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('especificos.unexpected_error')]);
        }
    }

    /**
     * Display the specified especifico.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $especifico = Especifico::with('user')->findOrFail($id);

        return view('especificos.show', compact('especifico'));
    }

    /**
     * Show the form for editing the specified especifico.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $especifico = Especifico::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('especificos.edit', compact('especifico','users','users'));
    }

    /**
     * Update the specified especifico in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EspecificosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EspecificosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $especifico = Especifico::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $especifico->update($data);

            return redirect()->route('especificos.especifico.index')
                             ->with('success_message', trans('especificos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('especificos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified especifico from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $especifico = Especifico::findOrFail($id);
            $especifico->delete();

            return redirect()->route('especificos.especifico.index')
                             ->with('success_message', trans('especificos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('especificos.unexpected_error')]);
        }
    }



}
