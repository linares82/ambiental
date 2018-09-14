<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Models\User;
use App\Models\Entity;
use App\Models\CsCatDoc;
use App\Models\Empleado;
use App\Models\SDocumento;
use App\Http\Controllers\Controller;
use App\Models\SEstatusProcedimiento;
use App\Http\Requests\SDocumentosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Carbon\Carbon;

class SDocumentosController extends Controller
{

    /**
     * Display a listing of the s documentos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=SDocumento::where('id', '<>', '0');
                $sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['documento_id']) and $input['documento_id']<>0){
			$r->where('documento_id', '=', $input['documento_id']);
		}
                if(isset($input['fec_ini_vigencia']) and $input['fec_ini_vigencia']<>0){
			$r->where('fec_ini_vigencia', '=', date_format(date_create($input['fec_ini_vigencia']),'Y/m/d'));
		}
                if (Auth::user()->canDo('filtro_entity')) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                $csCatDocs = CsCatDoc::pluck('cat_doc','id')->all();
		$sDocumentos = $r->with('cscatdoc','bnd','empleado','sestatusprocedimiento','entity','user')->paginate(25);
		//$sDocumentos = SDocumento::with('cscatdoc','bnd','empleado','sestatusprocedimiento','entity','user')->paginate(25);

        return view('s_documentos.index', compact('sDocumentos','sEstatusProcedimientos','csCatDocs'));
    }

    /**
     * Show the form for creating a new s documento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $csCatDocs = CsCatDoc::pluck('cat_doc','id')->all();
$bnds = Bnd::pluck('bnd','id')->all();
$empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
$sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('s_documentos.create', compact('csCatDocs','bnds','empleados','sEstatusProcedimientos','entities','users','users'));
    }

    /**
     * Store a new s documento in the storage.
     *
     * @param App\Http\Requests\SDocumentosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SDocumentosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
	    $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            $data['estatus_id']=1;
            $data['archivo']="";
            SDocumento::create($data);

            return redirect()->route('s_documentos.s_documento.index')
                             ->with('success_message', trans('s_documentos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_documentos.unexpected_error')]);
        }
    }

    /**
     * Display the specified s documento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $sDocumento = SDocumento::with('cscatdoc','bnd','empleado','sestatusprocedimiento','entity','user')->findOrFail($id);
        
        return view('s_documentos.show', compact('sDocumento'));
    }

    /**
     * Show the form for editing the specified s documento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sDocumento = SDocumento::findOrFail($id);
        $csCatDocs = CsCatDoc::pluck('cat_doc','id')->all();
$bnds = Bnd::pluck('bnd','id')->all();
$empleados = Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id')->all();
$sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();

        return view('s_documentos.edit', compact('sDocumento','csCatDocs','bnds','empleados','sEstatusProcedimientos','entities','users','users'));
    }

    /**
     * Update the specified s documento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SDocumentosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SDocumentosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $sDocumento = SDocumento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $sDocumento->update($data);

            return redirect()->route('s_documentos.s_documento.index')
                             ->with('success_message', trans('s_documentos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_documentos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified s documento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sDocumento = SDocumento::findOrFail($id);
            $sDocumento->delete();

            return redirect()->route('s_documentos.s_documento.index')
                             ->with('success_message', trans('s_documentos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_documentos.unexpected_error')]);
        }
    }

    public function comentarioEstatus(Request $request){
		$c=array();
		$c['s_documento_id']=$_POST['s_documento_id'];
		$c['comentario']=$_POST['comentario'];
		$c['estatus_id']=$_POST['estatus_id'];
		$c['usu_alta_id']=Sentry::getUser()->id;
		$c['usu_mod_id']=Sentry::getUser()->id;
		
		try{
		$comentario=new S_comentarios_documento($c);
		$s_documento=S_documento::findOrFail($c['s_documento_id']);
		$s_documento->comentarios()->save($comentario);
		$s_documento->estatus_id=$c['estatus_id'];
		$s_documento->save();
		echo json_encode(array('success'=>true));
		}
		catch(\Exception $e){
			DB::rollback();
    		//throw $e;
    		echo json_encode(array('msg'=>$e));
		}
		
	}

}
