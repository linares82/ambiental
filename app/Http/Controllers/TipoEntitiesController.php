<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TipoEntity;
use App\Http\Controllers\Controller;
use App\Http\Requests\TipoEntitiesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class TipoEntitiesController extends Controller
{

    /**
     * Display a listing of the tipo entities.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=TipoEntity::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$tipoEntities = $r->with('user')->paginate(25);
		//$tipoEntities = TipoEntity::with('user')->paginate(25);

        return view('tipo_entities.index', compact('tipoEntities'));
    }

    /**
     * Show the form for creating a new tipo entity.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('tipo_entities.create', compact('users','users'));
    }

    /**
     * Store a new tipo entity in the storage.
     *
     * @param App\Http\Requests\TipoEntitiesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(TipoEntitiesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            TipoEntity::create($data);

            return redirect()->route('tipo_entities.tipo_entity.index')
                             ->with('success_message', trans('tipo_entities.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tipo_entities.unexpected_error')]);
        }
    }

    /**
     * Display the specified tipo entity.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $tipoEntity = TipoEntity::with('user')->findOrFail($id);

        return view('tipo_entities.show', compact('tipoEntity'));
    }

    /**
     * Show the form for editing the specified tipo entity.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $tipoEntity = TipoEntity::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('tipo_entities.edit', compact('tipoEntity','users','users'));
    }

    /**
     * Update the specified tipo entity in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\TipoEntitiesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, TipoEntitiesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $tipoEntity = TipoEntity::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $tipoEntity->update($data);

            return redirect()->route('tipo_entities.tipo_entity.index')
                             ->with('success_message', trans('tipo_entities.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tipo_entities.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified tipo entity from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $tipoEntity = TipoEntity::findOrFail($id);
            $tipoEntity->delete();

            return redirect()->route('tipo_entities.tipo_entity.index')
                             ->with('success_message', trans('tipo_entities.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tipo_entities.unexpected_error')]);
        }
    }



}
