<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entity;
use App\Models\TipoEntity;
use App\Http\Controllers\Controller;
use App\Http\Requests\EntitiesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Storage;
use Auth;
use Log;

class EntitiesController extends Controller
{

    /**
     * Display a listing of the entities.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Entity::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$entities = $r->with('user')->paginate(25);
		//$entities = Entity::with('user','entidad')->paginate(25);

        return view('entities.index', compact('entities'));
    }

    /**
     * Show the form for creating a new entity.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        $tipoEntities = TipoEntity::pluck('tipo_entity','id')->all();
        //$entidads = Entity::pluck('id','id')->all();
        
        return view('entities.create', compact('users','tipoEntities'));
    }

    /**
     * Store a new entity in the storage.
     *
     * @param App\Http\Requests\EntitiesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EntitiesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $data['usu_alta_id']=Auth::user()->id;
            $data['usu_mod_id']=Auth::user()->id;
            try{
                $entidad=Entity::create($data);
            }catch(Exception $e){
                dd($e);
            }
            

            return redirect()->route('entities.entity.edit', $entidad->id)
                             ->with('success_message', trans('entities.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('entities.unexpected_error')]);
        }
    }

    /**
     * Display the specified entity.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $entity = Entity::with('user')->findOrFail($id);

        return view('entities.show', compact('entity'));
    }

    /**
     * Show the form for editing the specified entity.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $entity = Entity::findOrFail($id);
        $users = User::pluck('name','id')->all();
        $tipoEntities = TipoEntity::pluck('tipo_entity','id')->all();
        //dd($entity);
        //$entidads = Entity::pluck('id','id')->all();

        return view('entities.edit', compact('entity','users','tipoEntities'));
    }

    /**
     * Update the specified entity in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EntitiesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EntitiesFormRequest $request)
    {
        try {
            //dd($request->getData());
            $data = $request->getData();
            $data['usu_mod_id']=Auth::user()->id;
            
            $entity = Entity::findOrFail($id);
            $entity->update($data);

            return redirect()->route('entities.entity.index')
                             ->with('success_message', trans('entities.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('entities.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified entity from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $entity = Entity::findOrFail($id);
            $entity->delete();

            return redirect()->route('entities.entity.index')
                             ->with('success_message', trans('entities.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('entities.unexpected_error')]);
        }
    }

    public function cargaArchivo(Request $request) {
        //dd($request);
        try{
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $nombre = $file->getClientOriginalName();
                $nombre=date('dmYHmi').$nombre;
                $r = Storage::disk('entities')->put($nombre, \File::get($file));
                
                $data['logo']= $nombre;
                $entity = Entity::findOrFail($request->get('id'));
                $entity->update($data);
                
            } else {
                return "no";
            }

            if ($r) {
                return $nombre;
            } else {
                return "Error vuelva a intentarlo";
            }
        }catch(Exception $e){
            Log::info($e);
        }    
    }

}
