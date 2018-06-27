<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SDocumento;
use App\Http\Controllers\Controller;
use App\Models\SComentariosDocumento;
use App\Models\SEstatusProcedimiento;
use App\Http\Requests\SComentariosDocumentosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class SComentariosDocumentosController extends Controller
{

    /**
     * Display a listing of the s comentarios documentos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=SComentariosDocumento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$sComentariosDocumentos = $r->with('sdocumento','sestatusprocedimiento','user')->paginate(25);
		//$sComentariosDocumentos = SComentariosDocumento::with('sdocumento','sestatusprocedimiento','user')->paginate(25);

        return view('s_comentarios_documentos.index', compact('sComentariosDocumentos'));
    }

    /**
     * Show the form for creating a new s comentarios documento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $sDocumentos = SDocumento::pluck('descripcion','id')->all();
$sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('s_comentarios_documentos.create', compact('sDocumentos','sEstatusProcedimientos','users','users'));
    }

    /**
     * Store a new s comentarios documento in the storage.
     *
     * @param App\Http\Requests\SComentariosDocumentosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SComentariosDocumentosFormRequest $request)
    {
        //dd($request);
        try {
            
            $data = $request->getData();
            
	    $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            
            //dd($data);
            SComentariosDocumento::create($data);
            
            $sDocumento=SDocumento::find($data['s_documento_id']);
            $sDocumento->estatus_id=$data['estatus_id'];
            $sDocumento->save();

            return redirect()->route('s_comentarios_documentos.s_comentarios_documento.index')
                             ->with('success_message', trans('s_comentarios_documentos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_comentarios_documentos.unexpected_error')]);
        }
    }

    /**
     * Display the specified s comentarios documento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $sComentariosDocumento = SComentariosDocumento::with('sdocumento','sestatusprocedimiento','user')->findOrFail($id);

        return view('s_comentarios_documentos.show', compact('sComentariosDocumento'));
    }

    /**
     * Show the form for editing the specified s comentarios documento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sComentariosDocumento = SComentariosDocumento::findOrFail($id);
        $sDocumentos = SDocumento::pluck('descripcion','id')->all();
$sEstatusProcedimientos = SEstatusProcedimiento::pluck('estatus','id')->all();
$users = User::pluck('name','id')->all();

        return view('s_comentarios_documentos.edit', compact('sComentariosDocumento','sDocumentos','sEstatusProcedimientos','users','users'));
    }

    /**
     * Update the specified s comentarios documento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SComentariosDocumentosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SComentariosDocumentosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $sComentariosDocumento = SComentariosDocumento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $sComentariosDocumento->update($data);

            return redirect()->route('s_comentarios_documentos.s_comentarios_documento.index')
                             ->with('success_message', trans('s_comentarios_documentos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_comentarios_documentos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified s comentarios documento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sComentariosDocumento = SComentariosDocumento::findOrFail($id);
            $sComentariosDocumento->delete();

            return redirect()->route('s_comentarios_documentos.s_comentarios_documento.index')
                             ->with('success_message', trans('s_comentarios_documentos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_comentarios_documentos.unexpected_error')]);
        }
    }

    public function getComentarios(Request $request){
        //dd($request->all());
        $lineas=SComentariosDocumento::select('s_comentarios_documentos.id', 'comentario', 'estatus')
                                ->join('s_estatus_procedimientos as st', 'st.id','=','s_comentarios_documentos.estatus_id')
                                ->where('s_documento_id', '=', $request->get('s_documento'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'comentario'=>$l->comentario,
                                         'estatus'=>$l->estatus
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }

}
