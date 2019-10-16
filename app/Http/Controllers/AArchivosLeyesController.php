<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\CaAaDoc;
use App\Models\AArchivosLeye;
use App\Models\AArchivo;
use App\Http\Controllers\Controller;
use App\Http\Requests\AArchivosLeyesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;


class AArchivosLeyesController extends Controller
{

    /**
     * Display a listing of the a archivos leyes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AArchivosLeye::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aArchivosLeyes = $r->with('caaadoc','bnd','entity','user')->paginate(25);
		//$aArchivosLeyes = AArchivosLeye::with('caaadoc','bnd','entity','user')->paginate(25);

        return view('a_archivos_leyes.index', compact('aArchivosLeyes'));
    }

    /**
     * Show the form for creating a new a archivos leye.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caAaDocs = CaAaDoc::pluck('doc','id')->all();
$bnds = Bnd::where('id','>',0)->pluck('bnd','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('a_archivos_leyes.create', compact('caAaDocs','bnds','entities','users','users'));
    }

    /**
     * Store a new a archivos leye in the storage.
     *
     * @param App\Http\Requests\AArchivosLeyesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AArchivosLeyesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AArchivosLeye::create($data);

            return redirect()->route('a_archivos_leyes.a_archivos_leye.index')
                             ->with('success_message', trans('a_archivos_leyes.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_archivos_leyes.unexpected_error')]);
        }
    }

    /**
     * Display the specified a archivos leye.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aArchivosLeye = AArchivosLeye::with('caaadoc','bnd','entity','user')->findOrFail($id);

        return view('a_archivos_leyes.show', compact('aArchivosLeye'));
    }

    /**
     * Show the form for editing the specified a archivos leye.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aArchivosLeye = AArchivosLeye::findOrFail($id);
        $caAaDocs = CaAaDoc::pluck('doc','id')->all();
$bnds = Bnd::where('id', '>', 0)->pluck('bnd', 'id');
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();

        return view('a_archivos_leyes.edit', compact('aArchivosLeye','caAaDocs','bnds','entities','users','users'));
    }

    /**
     * Update the specified a archivos leye in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AArchivosLeyesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AArchivosLeyesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aArchivosLeye = AArchivosLeye::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aArchivosLeye->update($data);

            return redirect()->route('a_archivos_leyes.a_archivos_leye.index')
                             ->with('success_message', trans('a_archivos_leyes.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_archivos_leyes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a archivos leye from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aArchivosLeye = AArchivosLeye::findOrFail($id);
            $aArchivosLeye->delete();

            return redirect()->route('a_archivos_leyes.a_archivos_leye.index')
                             ->with('success_message', trans('a_archivos_leyes.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_archivos_leyes.unexpected_error')]);
        }
    }

    public function generar(Request $request){
        $datos=$request->all();
        //dd($datos);
        $documento=AArchivosLeye::find($datos['id']);
        $registrosActivos=AArchivosLeye::where('activo',1)->get();
        //dd($registrosActivos->toArray());
        
        foreach($registrosActivos as $registro){
            //dd($registro);
            //dd(date('Y/m/d',strtotime($registro->fec_fin_vigencia)));
            $regRevisar= AArchivo::where('documento_id',$registro->documento_id)
                                     ->where('descripcion',$registro->descripcion)
                                     ->where('entity_id',$documento->entity_id)
                                     ->first();
            //dd($registro);
            if(count($regRevisar)==0){
                $nuevo=new AArchivo;
                $nuevo->documento_id=$registro->documento_id;
                $nuevo->descripcion=$registro->descripcion;
                //dd($registro->fec_inicio_vigencia);
                //dd(date('d-m-Y h:m:i',strtotime($registro->fec_inicio_vigencia)));
                //dd(strtotime());
                $nuevo->fec_ini_vigencia= str_replace('/', '-', $registro->fec_inicio_vigencia);
                $nuevo->fec_fin_vigencia= str_replace('/', '-', $registro->fec_fin_vigencia);
                $nuevo->aviso=$registro->aviso;
                $nuevo->dias_aviso=$registro->dias_aviso;
                $nuevo->usu_alta_id=$registro->usu_alta_id;
                $nuevo->usu_mod_id=$registro->usu_mod_id;
                $nuevo->obs="";
                $nuevo->archivo="";
                $nuevo->responsable_id=1;
                $nuevo->st_archivo_id=1;
                $nuevo->entity_id=$documento->entity_id;
                //dd($nuevo);
                $nuevo->save();
            }
            
        }
        return redirect()->route('a_archivos_leyes.a_archivos_leye.index')
                    ->with('success_message', 'Proceso Terminado');
    }

}
