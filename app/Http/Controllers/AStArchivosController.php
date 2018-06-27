<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AStArchivo;
use App\Http\Controllers\Controller;
use App\Http\Requests\AStArchivosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AStArchivosController extends Controller
{

    /**
     * Display a listing of the a st archivos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AStArchivo::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aStArchivos = $r->with('user')->paginate(25);
		//$aStArchivos = AStArchivo::with('user')->paginate(25);

        return view('a_st_archivos.index', compact('aStArchivos'));
    }

    /**
     * Show the form for creating a new a st archivo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('a_st_archivos.create', compact('users','users'));
    }

    /**
     * Store a new a st archivo in the storage.
     *
     * @param App\Http\Requests\AStArchivosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AStArchivosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AStArchivo::create($data);

            return redirect()->route('a_st_archivos.a_st_archivo.index')
                             ->with('success_message', trans('a_st_archivos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_st_archivos.unexpected_error')]);
        }
    }

    /**
     * Display the specified a st archivo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aStArchivo = AStArchivo::with('user')->findOrFail($id);

        return view('a_st_archivos.show', compact('aStArchivo'));
    }

    /**
     * Show the form for editing the specified a st archivo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aStArchivo = AStArchivo::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('a_st_archivos.edit', compact('aStArchivo','users','users'));
    }

    /**
     * Update the specified a st archivo in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AStArchivosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AStArchivosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aStArchivo = AStArchivo::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aStArchivo->update($data);

            return redirect()->route('a_st_archivos.a_st_archivo.index')
                             ->with('success_message', trans('a_st_archivos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_st_archivos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a st archivo from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aStArchivo = AStArchivo::findOrFail($id);
            $aStArchivo->delete();

            return redirect()->route('a_st_archivos.a_st_archivo.index')
                             ->with('success_message', trans('a_st_archivos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_st_archivos.unexpected_error')]);
        }
    }



}
