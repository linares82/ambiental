<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cumplimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\CumplimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CumplimientosController extends Controller
{

    /**
     * Display a listing of the cumplimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Cumplimiento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$cumplimientos = $r->with('user')->paginate(25);
		//$cumplimientos = Cumplimiento::with('user')->paginate(25);

        return view('cumplimientos.index', compact('cumplimientos'));
    }

    /**
     * Show the form for creating a new cumplimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('cumplimientos.create', compact('users','users'));
    }

    /**
     * Store a new cumplimiento in the storage.
     *
     * @param App\Http\Requests\CumplimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CumplimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Cumplimiento::create($data);

            return redirect()->route('cumplimientos.cumplimiento.index')
                             ->with('success_message', trans('cumplimientos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cumplimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified cumplimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $cumplimiento = Cumplimiento::with('user')->findOrFail($id);

        return view('cumplimientos.show', compact('cumplimiento'));
    }

    /**
     * Show the form for editing the specified cumplimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $cumplimiento = Cumplimiento::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('cumplimientos.edit', compact('cumplimiento','users','users'));
    }

    /**
     * Update the specified cumplimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CumplimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CumplimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $cumplimiento = Cumplimiento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $cumplimiento->update($data);

            return redirect()->route('cumplimientos.cumplimiento.index')
                             ->with('success_message', trans('cumplimientos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cumplimientos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cumplimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $cumplimiento = Cumplimiento::findOrFail($id);
            $cumplimiento->delete();

            return redirect()->route('cumplimientos.cumplimiento.index')
                             ->with('success_message', trans('cumplimientos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cumplimientos.unexpected_error')]);
        }
    }



}
