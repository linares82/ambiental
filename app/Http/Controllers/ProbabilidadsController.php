<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Probabilidad;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProbabilidadsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ProbabilidadsController extends Controller
{

    /**
     * Display a listing of the probabilidads.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Probabilidad::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$probabilidads = $r->with('user')->paginate(25);
		//$probabilidads = Probabilidad::with('user')->paginate(25);

        return view('probabilidads.index', compact('probabilidads'));
    }

    /**
     * Show the form for creating a new probabilidad.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('probabilidads.create', compact('users','users'));
    }

    /**
     * Store a new probabilidad in the storage.
     *
     * @param App\Http\Requests\ProbabilidadsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ProbabilidadsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Probabilidad::create($data);

            return redirect()->route('probabilidads.probabilidad.index')
                             ->with('success_message', trans('probabilidads.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('probabilidads.unexpected_error')]);
        }
    }

    /**
     * Display the specified probabilidad.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $probabilidad = Probabilidad::with('user')->findOrFail($id);

        return view('probabilidads.show', compact('probabilidad'));
    }

    /**
     * Show the form for editing the specified probabilidad.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $probabilidad = Probabilidad::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('probabilidads.edit', compact('probabilidad','users','users'));
    }

    /**
     * Update the specified probabilidad in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ProbabilidadsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ProbabilidadsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $probabilidad = Probabilidad::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $probabilidad->update($data);

            return redirect()->route('probabilidads.probabilidad.index')
                             ->with('success_message', trans('probabilidads.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('probabilidads.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified probabilidad from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $probabilidad = Probabilidad::findOrFail($id);
            $probabilidad->delete();

            return redirect()->route('probabilidads.probabilidad.index')
                             ->with('success_message', trans('probabilidads.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('probabilidads.unexpected_error')]);
        }
    }



}
