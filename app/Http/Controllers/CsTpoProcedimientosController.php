<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsTpoProcedimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsTpoProcedimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsTpoProcedimientosController extends Controller
{

    /**
     * Display a listing of the cs tpo procedimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsTpoProcedimiento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$csTpoProcedimientos = $r->with('user')->paginate(25);
		//$csTpoProcedimientos = CsTpoProcedimiento::with('user')->paginate(25);

        return view('cs_tpo_procedimientos.index', compact('csTpoProcedimientos'));
    }

    /**
     * Show the form for creating a new cs tpo procedimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('cs_tpo_procedimientos.create', compact('users','users'));
    }

    /**
     * Store a new cs tpo procedimiento in the storage.
     *
     * @param App\Http\Requests\CsTpoProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsTpoProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsTpoProcedimiento::create($data);

            return redirect()->route('cs_tpo_procedimientos.cs_tpo_procedimiento.index')
                             ->with('success_message', trans('cs_tpo_procedimientos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_procedimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs tpo procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csTpoProcedimiento = CsTpoProcedimiento::with('user')->findOrFail($id);

        return view('cs_tpo_procedimientos.show', compact('csTpoProcedimiento'));
    }

    /**
     * Show the form for editing the specified cs tpo procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csTpoProcedimiento = CsTpoProcedimiento::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('cs_tpo_procedimientos.edit', compact('csTpoProcedimiento','users','users'));
    }

    /**
     * Update the specified cs tpo procedimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsTpoProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsTpoProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csTpoProcedimiento = CsTpoProcedimiento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csTpoProcedimiento->update($data);

            return redirect()->route('cs_tpo_procedimientos.cs_tpo_procedimiento.index')
                             ->with('success_message', trans('cs_tpo_procedimientos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_procedimientos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs tpo procedimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csTpoProcedimiento = CsTpoProcedimiento::findOrFail($id);
            $csTpoProcedimiento->delete();

            return redirect()->route('cs_tpo_procedimientos.cs_tpo_procedimiento.index')
                             ->with('success_message', trans('cs_tpo_procedimientos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_procedimientos.unexpected_error')]);
        }
    }



}
