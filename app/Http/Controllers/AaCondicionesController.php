<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AaCondicione;
use App\Http\Controllers\Controller;
use App\Http\Requests\AaCondicionesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AaCondicionesController extends Controller
{

    /**
     * Display a listing of the aa condiciones.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AaCondicione::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aaCondiciones = $r->with('user')->paginate(25);
		//$aaCondiciones = AaCondicione::with('user')->paginate(25);

        return view('aa_condiciones.index', compact('aaCondiciones'));
    }

    /**
     * Show the form for creating a new aa condicione.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('aa_condiciones.create', compact('users','users'));
    }

    /**
     * Store a new aa condicione in the storage.
     *
     * @param App\Http\Requests\AaCondicionesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AaCondicionesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AaCondicione::create($data);

            return redirect()->route('aa_condiciones.aa_condicione.index')
                             ->with('success_message', trans('aa_condiciones.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_condiciones.unexpected_error')]);
        }
    }

    /**
     * Display the specified aa condicione.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aaCondicione = AaCondicione::with('user')->findOrFail($id);

        return view('aa_condiciones.show', compact('aaCondicione'));
    }

    /**
     * Show the form for editing the specified aa condicione.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aaCondicione = AaCondicione::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('aa_condiciones.edit', compact('aaCondicione','users','users'));
    }

    /**
     * Update the specified aa condicione in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AaCondicionesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AaCondicionesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aaCondicione = AaCondicione::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aaCondicione->update($data);

            return redirect()->route('aa_condiciones.aa_condicione.index')
                             ->with('success_message', trans('aa_condiciones.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_condiciones.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified aa condicione from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aaCondicione = AaCondicione::findOrFail($id);
            $aaCondicione->delete();

            return redirect()->route('aa_condiciones.aa_condicione.index')
                             ->with('success_message', trans('aa_condiciones.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_condiciones.unexpected_error')]);
        }
    }



}
