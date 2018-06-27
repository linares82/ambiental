<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reversibilidad;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReversibilidadsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ReversibilidadsController extends Controller
{

    /**
     * Display a listing of the reversibilidads.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Reversibilidad::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$reversibilidads = $r->with('user')->paginate(25);
		//$reversibilidads = Reversibilidad::with('user')->paginate(25);

        return view('reversibilidads.index', compact('reversibilidads'));
    }

    /**
     * Show the form for creating a new reversibilidad.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('reversibilidads.create', compact('users','users'));
    }

    /**
     * Store a new reversibilidad in the storage.
     *
     * @param App\Http\Requests\ReversibilidadsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ReversibilidadsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Reversibilidad::create($data);

            return redirect()->route('reversibilidads.reversibilidad.index')
                             ->with('success_message', trans('reversibilidads.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('reversibilidads.unexpected_error')]);
        }
    }

    /**
     * Display the specified reversibilidad.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $reversibilidad = Reversibilidad::with('user')->findOrFail($id);

        return view('reversibilidads.show', compact('reversibilidad'));
    }

    /**
     * Show the form for editing the specified reversibilidad.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $reversibilidad = Reversibilidad::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('reversibilidads.edit', compact('reversibilidad','users','users'));
    }

    /**
     * Update the specified reversibilidad in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ReversibilidadsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ReversibilidadsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $reversibilidad = Reversibilidad::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $reversibilidad->update($data);

            return redirect()->route('reversibilidads.reversibilidad.index')
                             ->with('success_message', trans('reversibilidads.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('reversibilidads.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified reversibilidad from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $reversibilidad = Reversibilidad::findOrFail($id);
            $reversibilidad->delete();

            return redirect()->route('reversibilidads.reversibilidad.index')
                             ->with('success_message', trans('reversibilidads.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('reversibilidads.unexpected_error')]);
        }
    }



}
