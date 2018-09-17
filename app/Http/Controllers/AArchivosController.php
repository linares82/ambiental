<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\CaCaDoc;
use App\Models\AArchivo;
use App\Models\Empleado;
use App\Models\AStArchivo;
use App\Http\Controllers\Controller;
use App\Http\Requests\AArchivosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AArchivosController extends Controller
{

    /**
     * Display a listing of the a archivos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AArchivo::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['documento_id']) and $input['documento_id']<>null){
			$r->where('documento_id', '=', $input['documento_id']);
		}
                if(isset($input['fec_ini_vigencia']) and $input['fec_ini_vigencia']<>null){
			$r->where('fec_ini_vigencia', '=', date_format(date_create($input['fec_ini_vigencia']),'Y/m/d'));
		}
                if(isset($input['fec_fin_vigencia']) and $input['fec_fin_vigencia']<>null){
			$r->where('fec_fin_vigencia', '=', date_format(date_create($input['fec_fin_vigencia']),'Y/m/d'));
		}
                $entity=Entity::find(Auth::user()->entity_id);
                if (Auth::user()->canDo('filtro_entity') or $entity->filtred_by_entity==1) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
                    
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                $aStArchivos = AStArchivo::pluck('estatus','id')->all();
                $caCaDocs = CaCaDoc::pluck('doc','id')->all();
		$aArchivos = $r->with('cacadoc','bnd','empleado','astarchivo','entity','user')->paginate(25);
		//$aArchivos = AArchivo::with('cacadoc','bnd','empleado','astarchivo','entity','user')->paginate(25);

        return view('a_archivos.index', compact('aArchivos','aStArchivos','caCaDocs'));
    }

    /**
     * Show the form for creating a new a archivo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caCaDocs = CaCaDoc::pluck('doc','id')->all();
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
        $aStArchivos = AStArchivo::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('a_archivos.create', compact('caCaDocs','bnds','empleados','aStArchivos','entities','users','users'));
    }

    /**
     * Store a new a archivo in the storage.
     *
     * @param App\Http\Requests\AArchivosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AArchivosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            $data['st_archivo_id']=1;
            $data['archivo']="";
            AArchivo::create($data);

            return redirect()->route('a_archivos.a_archivo.index')
                             ->with('success_message', trans('a_archivos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_archivos.unexpected_error')]);
        }
    }

    /**
     * Display the specified a archivo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aArchivo = AArchivo::with('cacadoc','bnd','empleado','astarchivo','entity','user')->findOrFail($id);

        return view('a_archivos.show', compact('aArchivo'));
    }

    /**
     * Show the form for editing the specified a archivo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aArchivo = AArchivo::findOrFail($id);
        $caCaDocs = CaCaDoc::pluck('doc','id')->all();
        $bnds = Bnd::pluck('bnd','id')->all();
        $empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
        $aStArchivos = AStArchivo::pluck('estatus','id')->all();
        $entities = Entity::pluck('rzon_social','id')->all();
        $users = User::pluck('name','id')->all();

        return view('a_archivos.edit', compact('aArchivo','caCaDocs','bnds','empleados','aStArchivos','entities','users','users'));
    }

    /**
     * Update the specified a archivo in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AArchivosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AArchivosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aArchivo = AArchivo::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aArchivo->update($data);

            return redirect()->route('a_archivos.a_archivo.index')
                             ->with('success_message', trans('a_archivos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_archivos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a archivo from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aArchivo = AArchivo::findOrFail($id);
            $aArchivo->delete();

            return redirect()->route('a_archivos.a_archivo.index')
                             ->with('success_message', trans('a_archivos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_archivos.unexpected_error')]);
        }
    }



}
