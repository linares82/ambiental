<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entity;
use App\Models\MObjetivo;
use App\Http\Controllers\Controller;
use App\Http\Requests\MObjetivosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class MObjetivosController extends Controller
{

    /**
     * Display a listing of the m objetivos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=MObjetivo::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['objetivo']) and $input['objetivo']<>null){
			$r->where('objetivo', 'like', '%'.$input['objetivo'].'%');
		}
                $entity=Entity::find(Auth::user()->entity_id);
                if (Auth::user()->canDo('filtro_entity') or $entity->filtred_by_entity==1) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
		$mObjetivos = $r->with('user','entity')->paginate(25);
		//$mObjetivos = MObjetivo::with('user','entity')->paginate(25);

        return view('m_objetivos.index', compact('mObjetivos'));
    }

    /**
     * Show the form for creating a new m objetivo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
        
        return view('m_objetivos.create', compact('users','users','entities'));
    }

    /**
     * Store a new m objetivo in the storage.
     *
     * @param App\Http\Requests\MObjetivosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MObjetivosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            MObjetivo::create($data);

            return redirect()->route('m_objetivos.m_objetivo.index')
                             ->with('success_message', trans('m_objetivos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_objetivos.unexpected_error')]);
        }
    }

    /**
     * Display the specified m objetivo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $mObjetivo = MObjetivo::with('user','entity')->findOrFail($id);

        return view('m_objetivos.show', compact('mObjetivo'));
    }

    /**
     * Show the form for editing the specified m objetivo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $mObjetivo = MObjetivo::findOrFail($id);
        $users = User::pluck('name','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();

        return view('m_objetivos.edit', compact('mObjetivo','users','users','entities'));
    }

    /**
     * Update the specified m objetivo in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MObjetivosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MObjetivosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $mObjetivo = MObjetivo::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $mObjetivo->update($data);

            return redirect()->route('m_objetivos.m_objetivo.index')
                             ->with('success_message', trans('m_objetivos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_objetivos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified m objetivo from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $mObjetivo = MObjetivo::findOrFail($id);
            $mObjetivo->delete();

            return redirect()->route('m_objetivos.m_objetivo.index')
                             ->with('success_message', trans('m_objetivos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_objetivos.unexpected_error')]);
        }
    }



}
