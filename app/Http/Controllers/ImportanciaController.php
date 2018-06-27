<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Importancium;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportanciaFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ImportanciaController extends Controller
{

    /**
     * Display a listing of the importancia.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Importancium::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$importancia = $r->with('user')->paginate(25);
		//$importancia = Importancium::with('user')->paginate(25);

        return view('importancia.index', compact('importancia'));
    }

    /**
     * Show the form for creating a new importancium.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('importancia.create', compact('users','users'));
    }

    /**
     * Store a new importancium in the storage.
     *
     * @param App\Http\Requests\ImportanciaFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ImportanciaFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Importancium::create($data);

            return redirect()->route('importancia.importancium.index')
                             ->with('success_message', trans('importancia.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('importancia.unexpected_error')]);
        }
    }

    /**
     * Display the specified importancium.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $importancium = Importancium::with('user')->findOrFail($id);

        return view('importancia.show', compact('importancium'));
    }

    /**
     * Show the form for editing the specified importancium.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $importancium = Importancium::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('importancia.edit', compact('importancium','users','users'));
    }

    /**
     * Update the specified importancium in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ImportanciaFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ImportanciaFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $importancium = Importancium::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $importancium->update($data);

            return redirect()->route('importancia.importancium.index')
                             ->with('success_message', trans('importancia.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('importancia.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified importancium from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $importancium = Importancium::findOrFail($id);
            $importancium->delete();

            return redirect()->route('importancia.importancium.index')
                             ->with('success_message', trans('importancia.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('importancia.unexpected_error')]);
        }
    }



}
