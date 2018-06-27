<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Efecto;
use App\Http\Controllers\Controller;
use App\Http\Requests\EfectosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class EfectosController extends Controller
{

    /**
     * Display a listing of the efectos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Efecto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$efectos = $r->with('user')->paginate(25);
		//$efectos = Efecto::with('user')->paginate(25);

        return view('efectos.index', compact('efectos'));
    }

    /**
     * Show the form for creating a new efecto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('efectos.create', compact('users','users'));
    }

    /**
     * Store a new efecto in the storage.
     *
     * @param App\Http\Requests\EfectosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EfectosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Efecto::create($data);

            return redirect()->route('efectos.efecto.index')
                             ->with('success_message', trans('efectos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('efectos.unexpected_error')]);
        }
    }

    /**
     * Display the specified efecto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $efecto = Efecto::with('user')->findOrFail($id);

        return view('efectos.show', compact('efecto'));
    }

    /**
     * Show the form for editing the specified efecto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $efecto = Efecto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('efectos.edit', compact('efecto','users','users'));
    }

    /**
     * Update the specified efecto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EfectosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EfectosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $efecto = Efecto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $efecto->update($data);

            return redirect()->route('efectos.efecto.index')
                             ->with('success_message', trans('efectos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('efectos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified efecto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $efecto = Efecto::findOrFail($id);
            $efecto->delete();

            return redirect()->route('efectos.efecto.index')
                             ->with('success_message', trans('efectos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('efectos.unexpected_error')]);
        }
    }



}
