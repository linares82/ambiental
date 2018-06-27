<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AaAspecto;
use App\Http\Controllers\Controller;
use App\Http\Requests\AaAspectosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AaAspectosController extends Controller
{

    /**
     * Display a listing of the aa aspectos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AaAspecto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aaAspectos = $r->with('user')->paginate(25);
		//$aaAspectos = AaAspecto::with('user')->paginate(25);

        return view('aa_aspectos.index', compact('aaAspectos'));
    }

    /**
     * Show the form for creating a new aa aspecto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('aa_aspectos.create', compact('users','users'));
    }

    /**
     * Store a new aa aspecto in the storage.
     *
     * @param App\Http\Requests\AaAspectosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AaAspectosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AaAspecto::create($data);

            return redirect()->route('aa_aspectos.aa_aspecto.index')
                             ->with('success_message', trans('aa_aspectos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_aspectos.unexpected_error')]);
        }
    }

    /**
     * Display the specified aa aspecto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aaAspecto = AaAspecto::with('user')->findOrFail($id);

        return view('aa_aspectos.show', compact('aaAspecto'));
    }

    /**
     * Show the form for editing the specified aa aspecto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aaAspecto = AaAspecto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('aa_aspectos.edit', compact('aaAspecto','users','users'));
    }

    /**
     * Update the specified aa aspecto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AaAspectosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AaAspectosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aaAspecto = AaAspecto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aaAspecto->update($data);

            return redirect()->route('aa_aspectos.aa_aspecto.index')
                             ->with('success_message', trans('aa_aspectos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_aspectos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified aa aspecto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aaAspecto = AaAspecto::findOrFail($id);
            $aaAspecto->delete();

            return redirect()->route('aa_aspectos.aa_aspecto.index')
                             ->with('success_message', trans('aa_aspectos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_aspectos.unexpected_error')]);
        }
    }



}
