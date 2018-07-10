<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaProcedimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaProcedimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaProcedimientosController extends Controller
{

    /**
     * Display a listing of the ca procedimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaProcedimiento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['procedimiento']) and $input['procedimiento']<>null){
			$r->where('procedimiento', 'like', '%'.$input['procedimiento'].'%');
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$caProcedimientos = $r->with('user')->paginate(25);
		//$caProcedimientos = CaProcedimiento::with('user')->paginate(25);

        return view('ca_procedimientos.index', compact('caProcedimientos'));
    }

    /**
     * Show the form for creating a new ca procedimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('ca_procedimientos.create', compact('users','users'));
    }

    /**
     * Store a new ca procedimiento in the storage.
     *
     * @param App\Http\Requests\CaProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaProcedimiento::create($data);

            return redirect()->route('ca_procedimientos.ca_procedimiento.index')
                             ->with('success_message', trans('ca_procedimientos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_procedimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caProcedimiento = CaProcedimiento::with('user')->findOrFail($id);

        return view('ca_procedimientos.show', compact('caProcedimiento'));
    }

    /**
     * Show the form for editing the specified ca procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caProcedimiento = CaProcedimiento::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('ca_procedimientos.edit', compact('caProcedimiento','users','users'));
    }

    /**
     * Update the specified ca procedimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caProcedimiento = CaProcedimiento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caProcedimiento->update($data);

            return redirect()->route('ca_procedimientos.ca_procedimiento.index')
                             ->with('success_message', trans('ca_procedimientos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_procedimientos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca procedimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caProcedimiento = CaProcedimiento::findOrFail($id);
            $caProcedimiento->delete();

            return redirect()->route('ca_procedimientos.ca_procedimiento.index')
                             ->with('success_message', trans('ca_procedimientos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_procedimientos.unexpected_error')]);
        }
    }



}
