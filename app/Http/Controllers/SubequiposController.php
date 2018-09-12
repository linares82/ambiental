<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\Entity;
use App\Models\Subequipo;
use App\Models\MObjetivo;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubequiposFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class SubequiposController extends Controller
{

    /**
     * Display a listing of the subequipos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Subequipo::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['equipo_id']) and $input['equipo_id']<>null){
			$r->where('equipo_id', '=', $input['equipo_id']);
		}
		if(isset($input['subequipo']) and $input['subequipo']<>null){
			$r->where('subequipo', 'like', '%'.$input['subequipo'].'%');
		}
                if (Auth::user()->canDo('filtro_entity')) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
                $mObjetivos = MObjetivo::pluck('objetivo','id')->all();
                $areas = Area::pluck('area','id')->all();
		$subequipos = $r->with('mobjetivo','area','user','entity')->paginate(25);
		//$subequipos = Subequipo::with('mobjetivo','area','user','entity')->paginate(25);

        return view('subequipos.index', compact('subequipos','mObjetivos','areas'));
    }

    /**
     * Show the form for creating a new subequipo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $mObjetivos = MObjetivo::pluck('objetivo','id')->all();
$areas = Area::pluck('area','id')->all();
$users = User::pluck('name','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
        
        return view('subequipos.create', compact('mObjetivos','areas','users','users','entities'));
    }

    /**
     * Store a new subequipo in the storage.
     *
     * @param App\Http\Requests\SubequiposFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SubequiposFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            //dd($data);
            try
            {
                Subequipo::create($data);
            }catch(Exception $e){
                dd($e);
            }            

            return redirect()->route('subequipos.subequipo.index')
                             ->with('success_message', trans('subequipos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('subequipos.unexpected_error')]);
        }
    }

    /**
     * Display the specified subequipo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $subequipo = Subequipo::with('mobjetivo','area','user','entity')->findOrFail($id);

        return view('subequipos.show', compact('subequipo'));
    }

    /**
     * Show the form for editing the specified subequipo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $subequipo = Subequipo::findOrFail($id);
        $mObjetivos = MObjetivo::pluck('objetivo','id')->all();
$areas = Area::pluck('area','id')->all();
$users = User::pluck('name','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();

        return view('subequipos.edit', compact('subequipo','mObjetivos','areas','users','users','entities'));
    }

    /**
     * Update the specified subequipo in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SubequiposFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SubequiposFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $subequipo = Subequipo::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $subequipo->update($data);

            return redirect()->route('subequipos.subequipo.index')
                             ->with('success_message', trans('subequipos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('subequipos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified subequipo from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $subequipo = Subequipo::findOrFail($id);
            $subequipo->delete();

            return redirect()->route('subequipos.subequipo.index')
                             ->with('success_message', trans('subequipos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('subequipos.unexpected_error')]);
        }
    }



}
