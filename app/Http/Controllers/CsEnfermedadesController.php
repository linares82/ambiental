<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsEnfermedade;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsEnfermedadesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsEnfermedadesController extends Controller
{

    /**
     * Display a listing of the cs enfermedades.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsEnfermedade::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$csEnfermedades = $r->with('user')->paginate(25);
		//$csEnfermedades = CsEnfermedade::with('user')->paginate(25);

        return view('cs_enfermedades.index', compact('csEnfermedades'));
    }

    /**
     * Show the form for creating a new cs enfermedade.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('cs_enfermedades.create', compact('users','users'));
    }

    /**
     * Store a new cs enfermedade in the storage.
     *
     * @param App\Http\Requests\CsEnfermedadesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsEnfermedadesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsEnfermedade::create($data);

            return redirect()->route('cs_enfermedades.cs_enfermedade.index')
                             ->with('success_message', trans('cs_enfermedades.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_enfermedades.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs enfermedade.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csEnfermedade = CsEnfermedade::with('user')->findOrFail($id);

        return view('cs_enfermedades.show', compact('csEnfermedade'));
    }

    /**
     * Show the form for editing the specified cs enfermedade.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csEnfermedade = CsEnfermedade::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('cs_enfermedades.edit', compact('csEnfermedade','users','users'));
    }

    /**
     * Update the specified cs enfermedade in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsEnfermedadesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsEnfermedadesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csEnfermedade = CsEnfermedade::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csEnfermedade->update($data);

            return redirect()->route('cs_enfermedades.cs_enfermedade.index')
                             ->with('success_message', trans('cs_enfermedades.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_enfermedades.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs enfermedade from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csEnfermedade = CsEnfermedade::findOrFail($id);
            $csEnfermedade->delete();

            return redirect()->route('cs_enfermedades.cs_enfermedade.index')
                             ->with('success_message', trans('cs_enfermedades.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_enfermedades.unexpected_error')]);
        }
    }



}
