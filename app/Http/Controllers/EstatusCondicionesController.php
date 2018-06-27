<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EstatusCondicione;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstatusCondicionesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class EstatusCondicionesController extends Controller
{

    /**
     * Display a listing of the estatus condiciones.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=EstatusCondicione::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$estatusCondiciones = $r->with('user')->paginate(25);
		//$estatusCondiciones = EstatusCondicione::with('user')->paginate(25);

        return view('estatus_condiciones.index', compact('estatusCondiciones'));
    }

    /**
     * Show the form for creating a new estatus condicione.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('estatus_condiciones.create', compact('users','users'));
    }

    /**
     * Store a new estatus condicione in the storage.
     *
     * @param App\Http\Requests\EstatusCondicionesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EstatusCondicionesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            EstatusCondicione::create($data);

            return redirect()->route('estatus_condiciones.estatus_condicione.index')
                             ->with('success_message', trans('estatus_condiciones.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('estatus_condiciones.unexpected_error')]);
        }
    }

    /**
     * Display the specified estatus condicione.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $estatusCondicione = EstatusCondicione::with('user')->findOrFail($id);

        return view('estatus_condiciones.show', compact('estatusCondicione'));
    }

    /**
     * Show the form for editing the specified estatus condicione.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $estatusCondicione = EstatusCondicione::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('estatus_condiciones.edit', compact('estatusCondicione','users','users'));
    }

    /**
     * Update the specified estatus condicione in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EstatusCondicionesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EstatusCondicionesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $estatusCondicione = EstatusCondicione::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $estatusCondicione->update($data);

            return redirect()->route('estatus_condiciones.estatus_condicione.index')
                             ->with('success_message', trans('estatus_condiciones.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('estatus_condiciones.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified estatus condicione from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $estatusCondicione = EstatusCondicione::findOrFail($id);
            $estatusCondicione->delete();

            return redirect()->route('estatus_condiciones.estatus_condicione.index')
                             ->with('success_message', trans('estatus_condiciones.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('estatus_condiciones.unexpected_error')]);
        }
    }



}
