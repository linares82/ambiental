<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TpoDoc;
use App\Models\CsNorma;
use App\Models\Empleado;
use App\Models\RDocumento;
use App\Models\CsGrupoNorma;
use App\Models\Importancium;
use App\Models\RevDocumental;
use App\Models\RevDocumentalLn;
use App\Models\EstatusRequisito;
use App\Http\Controllers\Controller;
use App\Http\Requests\RevDocumentalLnsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class RevDocumentalLnsController extends Controller
{

    /**
     * Display a listing of the rev documental lns.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=RevDocumentalLn::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$revDocumentalLns = $r->with('revdocumental','tpodoc','rdocumento','csgruponorma','csnorma','estatusrequisito','importancium','empleado','user')->paginate(25);
		//$revDocumentalLns = RevDocumentalLn::with('revdocumental','tpodoc','rdocumento','csgruponorma','csnorma','estatusrequisito','importancium','empleado','user')->paginate(25);

        return view('rev_documental_lns.index', compact('revDocumentalLns'));
    }

    /**
     * Show the form for creating a new rev documental ln.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $revDocumentals = RevDocumental::pluck('anio','id')->all();
        $tpoDocs = TpoDoc::pluck('tpo_doc','id')->all();
        $rDocumentos = RDocumento::pluck('r_documento','id')->all();
        $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
        $csNormas = CsNorma::pluck('norma','id')->all();
        $estatusRequisitos = EstatusRequisito::pluck('estatus','id')->all();
        $importancia = Importancium::pluck('importancia','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('rev_documental_lns.create', compact('revDocumentals','tpoDocs','rDocumentos','csGrupoNormas','csNormas','estatusRequisitos','importancia','empleados','users','users'));
    }

    /**
     * Store a new rev documental ln in the storage.
     *
     * @param App\Http\Requests\RevDocumentalLnsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RevDocumentalLnsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            RevDocumentalLn::create($data);

            return redirect()->route('rev_documentals.rev_documental.index')
                             ->with('success_message', trans('rev_documental_lns.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_documental_lns.unexpected_error')]);
        }
    }

    /**
     * Display the specified rev documental ln.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $revDocumentalLn = RevDocumentalLn::with('revdocumental','tpodoc','rdocumento','csgruponorma','csnorma','estatusrequisito','importancium','empleado','user')->findOrFail($id);

        return view('rev_documental_lns.show', compact('revDocumentalLn'));
    }

    /**
     * Show the form for editing the specified rev documental ln.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $revDocumentalLn = RevDocumentalLn::findOrFail($id);
        $revDocumentals = RevDocumental::pluck('anio','id')->all();
        $tpoDocs = TpoDoc::pluck('tpo_doc','id')->all();
        $rDocumentos = RDocumento::pluck('r_documento','id')->all();
        $csGrupoNormas = CsGrupoNorma::pluck('grupo_norma','id')->all();
        $csNormas = CsNorma::pluck('norma','id')->all();
        $estatusRequisitos = EstatusRequisito::pluck('estatus','id')->all();
        $importancia = Importancium::pluck('importancia','id')->all();
        $empleados = Empleado::pluck('nombre','id')->all();   
        $users = User::pluck('name','id')->all();

        //dd($revDocumentalLn->files);
        return view('rev_documental_lns.edit', compact('revDocumentalLn','revDocumentals','tpoDocs','rDocumentos','csGrupoNormas','csNormas','estatusRequisitos','importancia','empleados','users','users'));
    }

    /**
     * Update the specified rev documental ln in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RevDocumentalLnsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RevDocumentalLnsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $revDocumentalLn = RevDocumentalLn::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $revDocumentalLn->update($data);

            return redirect()->route('rev_documentals.rev_documental.index')
                             ->with('success_message', trans('rev_documental_lns.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_documental_lns.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified rev documental ln from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $revDocumentalLn = RevDocumentalLn::findOrFail($id);
            $revDocumentalLn->delete();

            return redirect()->route('rev_documental_lns.rev_documental_ln.index')
                             ->with('success_message', trans('rev_documental_lns.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_documental_lns.unexpected_error')]);
        }
    }

        public function getByEnc(Request $request){
        //dd($request->all());
        $lineas=RevDocumentalLn::select('rev_documental_lns.id','rev_documental_lns.rev_documental_id','td.tpo_doc','d.r_documento','archivo',
                                        'fec_cumplimiento','fec_vencimiento','st.estatus', 'i.importancia')
                         ->join('tpo_docs as td','td.id', '=', 'rev_documental_lns.tpo_documento_id')
                         ->join('r_documentos as d','d.id', '=', 'rev_documental_lns.documento_id')
                         ->join('estatus_requisitos as st','st.id', '=', 'rev_documental_lns.estatus_id')
                         ->join('importancia as i','i.id', '=', 'rev_documental_lns.importancia_id')
                         ->where('rev_documental_id', '=', $request->get('rev_documental'))
                         ->get();
        $resultado=array();
        //dd($lineas->toArray());
        
        foreach($lineas as $l){
            //count($l->files);
            array_push($resultado, array('id'=>$l->id,
                                         'tpo_doc'=>$l->tpo_doc,
                                         'documento'=>$l->r_documento,
                                         'archivo'=>count($l->files),
                                         'estatus'=>$l->estatus,
                                         'fec_cumplimiento'=>$l->fec_cumplimiento->format('Y-m-d'),
                                         'dias1'=>\Carbon\Carbon::now()->diffInDays($l->fec_cumplimiento),
                                         'fec_vencimiento'=>$l->fec_vencimiento->format('Y-m-d'),
                                         'dias2'=>\Carbon\Carbon::now()->diffInDays($l->fec_vencimiento),
                                         'importancia'=>$l->importancia
                                         ));
        }
        //dd($resultado);
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }


}
