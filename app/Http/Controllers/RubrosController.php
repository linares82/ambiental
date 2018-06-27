<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rubro;
use App\Http\Controllers\Controller;
use App\Http\Requests\RubrosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class RubrosController extends Controller
{

    /**
     * Display a listing of the rubros.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Rubro::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$rubros = $r->with('user')->paginate(25);
		//$rubros = Rubro::with('user')->paginate(25);

        return view('rubros.index', compact('rubros'));
    }

    /**
     * Show the form for creating a new rubro.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('rubros.create', compact('users','users'));
    }

    /**
     * Store a new rubro in the storage.
     *
     * @param App\Http\Requests\RubrosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RubrosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Rubro::create($data);

            return redirect()->route('rubros.rubro.index')
                             ->with('success_message', trans('rubros.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rubros.unexpected_error')]);
        }
    }

    /**
     * Display the specified rubro.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $rubro = Rubro::with('user')->findOrFail($id);

        return view('rubros.show', compact('rubro'));
    }

    /**
     * Show the form for editing the specified rubro.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $rubro = Rubro::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('rubros.edit', compact('rubro','users','users'));
    }

    /**
     * Update the specified rubro in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RubrosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RubrosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $rubro = Rubro::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $rubro->update($data);

            return redirect()->route('rubros.rubro.index')
                             ->with('success_message', trans('rubros.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rubros.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified rubro from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $rubro = Rubro::findOrFail($id);
            $rubro->delete();

            return redirect()->route('rubros.rubro.index')
                             ->with('success_message', trans('rubros.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rubros.unexpected_error')]);
        }
    }



}
