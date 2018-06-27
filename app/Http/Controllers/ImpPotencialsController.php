<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ImpPotencial;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImpPotencialsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ImpPotencialsController extends Controller
{

    /**
     * Display a listing of the imp potencials.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=ImpPotencial::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$impPotencials = $r->with('user')->paginate(25);
		//$impPotencials = ImpPotencial::with('user')->paginate(25);

        return view('imp_potencials.index', compact('impPotencials'));
    }

    /**
     * Show the form for creating a new imp potencial.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('imp_potencials.create', compact('users','users'));
    }

    /**
     * Store a new imp potencial in the storage.
     *
     * @param App\Http\Requests\ImpPotencialsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ImpPotencialsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            ImpPotencial::create($data);

            return redirect()->route('imp_potencials.imp_potencial.index')
                             ->with('success_message', trans('imp_potencials.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('imp_potencials.unexpected_error')]);
        }
    }

    /**
     * Display the specified imp potencial.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $impPotencial = ImpPotencial::with('user')->findOrFail($id);

        return view('imp_potencials.show', compact('impPotencial'));
    }

    /**
     * Show the form for editing the specified imp potencial.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $impPotencial = ImpPotencial::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('imp_potencials.edit', compact('impPotencial','users','users'));
    }

    /**
     * Update the specified imp potencial in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ImpPotencialsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ImpPotencialsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $impPotencial = ImpPotencial::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $impPotencial->update($data);

            return redirect()->route('imp_potencials.imp_potencial.index')
                             ->with('success_message', trans('imp_potencials.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('imp_potencials.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified imp potencial from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $impPotencial = ImpPotencial::findOrFail($id);
            $impPotencial->delete();

            return redirect()->route('imp_potencials.imp_potencial.index')
                             ->with('success_message', trans('imp_potencials.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('imp_potencials.unexpected_error')]);
        }
    }



}
