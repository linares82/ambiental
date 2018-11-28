<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\CsCatDoc;
use App\Models\SDocumento;
use App\Models\SDocumentosLeye;
use App\Http\Controllers\Controller;
use App\Http\Requests\SDocumentosLeyesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class SDocumentosLeyesController extends Controller
{

    /**
     * Display a listing of the s documentos leyes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=SDocumentosLeye::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$sDocumentosLeyes = $r->with('cscatdoc','bnd','entity','user')->paginate(25);
		//$sDocumentosLeyes = SDocumentosLeye::with('cscatdoc','bnd','entity','user')->paginate(25);

        return view('s_documentos_leyes.index', compact('sDocumentosLeyes'));
    }

    /**
     * Show the form for creating a new s documentos leye.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $csCatDocs = CsCatDoc::pluck('cat_doc','id')->all();
$bnds = Bnd::where('id','>',0)->pluck('bnd','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('s_documentos_leyes.create', compact('csCatDocs','bnds','entities','users','users'));
    }

    /**
     * Store a new s documentos leye in the storage.
     *
     * @param App\Http\Requests\SDocumentosLeyesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SDocumentosLeyesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            SDocumentosLeye::create($data);

            return redirect()->route('s_documentos_leyes.s_documentos_leye.index')
                             ->with('success_message', trans('s_documentos_leyes.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_documentos_leyes.unexpected_error')]);
        }
    }

    /**
     * Display the specified s documentos leye.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $sDocumentosLeye = SDocumentosLeye::with('cscatdoc','bnd','entity','user')->findOrFail($id);

        return view('s_documentos_leyes.show', compact('sDocumentosLeye'));
    }

    /**
     * Show the form for editing the specified s documentos leye.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sDocumentosLeye = SDocumentosLeye::findOrFail($id);
        $csCatDocs = CsCatDoc::pluck('cat_doc','id')->all();
$bnds = Bnd::where('id','>',0)->pluck('bnd','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();

        return view('s_documentos_leyes.edit', compact('sDocumentosLeye','csCatDocs','bnds','entities','users','users'));
    }

    /**
     * Update the specified s documentos leye in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SDocumentosLeyesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SDocumentosLeyesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $sDocumentosLeye = SDocumentosLeye::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $sDocumentosLeye->update($data);

            return redirect()->route('s_documentos_leyes.s_documentos_leye.index')
                             ->with('success_message', trans('s_documentos_leyes.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_documentos_leyes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified s documentos leye from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sDocumentosLeye = SDocumentosLeye::findOrFail($id);
            $sDocumentosLeye->delete();

            return redirect()->route('s_documentos_leyes.s_documentos_leye.index')
                             ->with('success_message', trans('s_documentos_leyes.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_documentos_leyes.unexpected_error')]);
        }
    }

    public function generar(Request $request){
        $datos=$request->all();
        //dd($datos);
        $documento= SDocumentosLeye::find($datos['id']);
        $registrosActivos=SDocumentosLeye::where('activo',1)->get();
        //dd($registrosActivos->toArray());
        
        foreach($registrosActivos as $registro){
            //dd($registro);
            //dd(date('Y/m/d',strtotime($registro->fec_fin_vigencia)));
            $regRevisar= SDocumento::where('documento_id',$registro->documento_id)
                                     ->where('descripcion',$registro->descripcion)
                                     ->where('entity_id',$documento->entity_id)
                                     ->first();
            //dd($registro);
            if(count($regRevisar)==0){
                $nuevo=new SDocumento;
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
                $nuevo->observaciones="";
                $nuevo->archivo="";
                $nuevo->responsable_id=1;
                $nuevo->estatus_id=1;
                $nuevo->entity_id=$documento->entity_id;
                //dd($nuevo);
                $nuevo->save();
            }
            
        }
        return redirect()->route('s_documentos_leyes.s_documentos_leye.index')
                    ->with('success_message', 'Proceso Terminado');
    }

}
