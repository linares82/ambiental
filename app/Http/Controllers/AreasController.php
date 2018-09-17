<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\Entity;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AreasController extends Controller
{

    /**
     * Display a listing of the areas.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Area::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['area']) and $input['area']<>null){
			$r->where('area', 'like', '%'.$input['area'].'%');
		}
                $entity=Entity::find(Auth::user()->entity_id);
                if (Auth::user()->canDo('filtro_entity') or $entity->filtred_by_entity==1) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$areas = $r->with('user','entity')->paginate(25);
		//$areas = Area::with('user','entity')->paginate(25);

        return view('areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new area.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
        
        return view('areas.create', compact('users','users','entities'));
    }

    /**
     * Store a new area in the storage.
     *
     * @param App\Http\Requests\AreasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AreasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id'] = Auth::user()->entity_id;
            Area::create($data);

            return redirect()->route('areas.area.index')
                             ->with('success_message', trans('areas.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('areas.unexpected_error')]);
        }
    }

    /**
     * Display the specified area.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $area = Area::with('user','entity')->findOrFail($id);

        return view('areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified area.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        $users = User::pluck('name','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();

        return view('areas.edit', compact('area','users','users','entities'));
    }

    /**
     * Update the specified area in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AreasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AreasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $area = Area::findOrFail($id);
            $data['usu_mod_id']=Auth::user()->id;
            
            $area->update($data);

            return redirect()->route('areas.area.index')
                             ->with('success_message', trans('areas.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('areas.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified area from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $area = Area::findOrFail($id);
            $area->delete();

            return redirect()->route('areas.area.index')
                             ->with('success_message', trans('areas.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('areas.unexpected_error')]);
        }
    }



}
