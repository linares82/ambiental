<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaConsumible;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaConsumiblesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaConsumiblesController extends Controller
{

    /**
     * Display a listing of the ca consumibles.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaConsumible::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['consumible']) and $input['consumible']<>""){
			$r->where('consumible', 'like', '%'.$input['consumible'].'%');
		}
		$caConsumibles = $r->with('user')->paginate(25);
		//$caConsumibles = CaConsumible::with('user')->paginate(25);

        return view('ca_consumibles.index', compact('caConsumibles'));
    }

    /**
     * Show the form for creating a new ca consumible.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('ca_consumibles.create', compact('users','users'));
    }

    /**
     * Store a new ca consumible in the storage.
     *
     * @param App\Http\Requests\CaConsumiblesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaConsumiblesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaConsumible::create($data);

            return redirect()->route('ca_consumibles.ca_consumible.index')
                             ->with('success_message', trans('ca_consumibles.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_consumibles.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca consumible.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caConsumible = CaConsumible::with('user')->findOrFail($id);

        return view('ca_consumibles.show', compact('caConsumible'));
    }

    /**
     * Show the form for editing the specified ca consumible.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caConsumible = CaConsumible::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('ca_consumibles.edit', compact('caConsumible','users','users'));
    }

    /**
     * Update the specified ca consumible in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaConsumiblesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaConsumiblesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caConsumible = CaConsumible::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caConsumible->update($data);

            return redirect()->route('ca_consumibles.ca_consumible.index')
                             ->with('success_message', trans('ca_consumibles.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_consumibles.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca consumible from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caConsumible = CaConsumible::findOrFail($id);
            $caConsumible->delete();

            return redirect()->route('ca_consumibles.ca_consumible.index')
                             ->with('success_message', trans('ca_consumibles.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_consumibles.unexpected_error')]);
        }
    }



}
