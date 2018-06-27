<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EstatusRequisito;
use App\Http\Controllers\Controller;
use App\Http\Requests\EstatusRequisitosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class EstatusRequisitosController extends Controller
{

    /**
     * Display a listing of the estatus requisitos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=EstatusRequisito::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$estatusRequisitos = $r->with('user')->paginate(25);
		//$estatusRequisitos = EstatusRequisito::with('user')->paginate(25);

        return view('estatus_requisitos.index', compact('estatusRequisitos'));
    }

    /**
     * Show the form for creating a new estatus requisito.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('estatus_requisitos.create', compact('users','users'));
    }

    /**
     * Store a new estatus requisito in the storage.
     *
     * @param App\Http\Requests\EstatusRequisitosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EstatusRequisitosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            EstatusRequisito::create($data);

            return redirect()->route('estatus_requisitos.estatus_requisito.index')
                             ->with('success_message', trans('estatus_requisitos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('estatus_requisitos.unexpected_error')]);
        }
    }

    /**
     * Display the specified estatus requisito.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $estatusRequisito = EstatusRequisito::with('user')->findOrFail($id);

        return view('estatus_requisitos.show', compact('estatusRequisito'));
    }

    /**
     * Show the form for editing the specified estatus requisito.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $estatusRequisito = EstatusRequisito::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('estatus_requisitos.edit', compact('estatusRequisito','users','users'));
    }

    /**
     * Update the specified estatus requisito in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EstatusRequisitosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EstatusRequisitosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $estatusRequisito = EstatusRequisito::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $estatusRequisito->update($data);

            return redirect()->route('estatus_requisitos.estatus_requisito.index')
                             ->with('success_message', trans('estatus_requisitos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('estatus_requisitos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified estatus requisito from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $estatusRequisito = EstatusRequisito::findOrFail($id);
            $estatusRequisito->delete();

            return redirect()->route('estatus_requisitos.estatus_requisito.index')
                             ->with('success_message', trans('estatus_requisitos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('estatus_requisitos.unexpected_error')]);
        }
    }



}
