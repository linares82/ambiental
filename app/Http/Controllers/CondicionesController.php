<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AaImpacto;
use App\Models\Condicione;
use App\Http\Controllers\Controller;
use App\Http\Requests\CondicionesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CondicionesController extends Controller
{

    /**
     * Display a listing of the condiciones.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Condicione::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['impacto_id']) and $input['impacto_id']<>null){
			$r->where('impacto_id', '=', $input['impacto_id']);
		}
		if(isset($input['condicion']) and $input['condicion']<>null){
			$r->where('condicion', 'like', '%'.$input['condicion'].'%');
		}
                $aaImpactos = AaImpacto::pluck('impacto','id')->all();
		$condiciones = $r->with('aaimpacto')->paginate(25);
		//$condiciones = Condicione::with('aaimpacto')->paginate(25);

        return view('condiciones.index', compact('condiciones','aaImpactos'));
    }

    /**
     * Show the form for creating a new condicione.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $aaImpactos = AaImpacto::pluck('impacto','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('condiciones.create', compact('aaImpactos','users','users'));
    }

    /**
     * Store a new condicione in the storage.
     *
     * @param App\Http\Requests\CondicionesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CondicionesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Condicione::create($data);

            return redirect()->route('condiciones.condicione.index')
                             ->with('success_message', trans('condiciones.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('condiciones.unexpected_error')]);
        }
    }

    /**
     * Display the specified condicione.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $condicione = Condicione::with('aaimpacto','user')->findOrFail($id);

        return view('condiciones.show', compact('condicione'));
    }

    /**
     * Show the form for editing the specified condicione.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $condicione = Condicione::findOrFail($id);
        $aaImpactos = AaImpacto::pluck('impacto','id')->all();
$users = User::pluck('name','id')->all();

        return view('condiciones.edit', compact('condicione','aaImpactos','users','users'));
    }

    /**
     * Update the specified condicione in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CondicionesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CondicionesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $condicione = Condicione::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $condicione->update($data);

            return redirect()->route('condiciones.condicione.index')
                             ->with('success_message', trans('condiciones.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('condiciones.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified condicione from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $condicione = Condicione::findOrFail($id);
            $condicione->delete();

            return redirect()->route('condiciones.condicione.index')
                             ->with('success_message', trans('condiciones.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('condiciones.unexpected_error')]);
        }
    }



}
