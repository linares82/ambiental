<?php

namespace App\Http\Controllers;

use App\Models\SDocumento;
use App\Models\FilesSDocumento;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilesSDocumentosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Storage;

class FilesSDocumentosController extends Controller
{

    /**
     * Display a listing of the files s documentos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=FilesSDocumento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$filesSDocumentos = $r->with('sdocumento')->paginate(25);
		//$filesSDocumentos = FilesSDocumento::with('sdocumento')->paginate(25);

        return view('files_s_documentos.index', compact('filesSDocumentos'));
    }

    /**
     * Show the form for creating a new files s documento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $sDocumentos = SDocumento::pluck('descripcion','id')->all();
        
        return view('files_s_documentos.create', compact('sDocumentos'));
    }

    /**
     * Store a new files s documento in the storage.
     *
     * @param App\Http\Requests\FilesSDocumentosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(FilesSDocumentosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            FilesSDocumento::create($data);

            return redirect()->route('files_s_documentos.files_s_documento.index')
                             ->with('success_message', trans('files_s_documentos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_s_documentos.unexpected_error')]);
        }
    }

    /**
     * Display the specified files s documento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $filesSDocumento = FilesSDocumento::with('sdocumento')->findOrFail($id);

        return view('files_s_documentos.show', compact('filesSDocumento'));
    }

    /**
     * Show the form for editing the specified files s documento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $filesSDocumento = FilesSDocumento::findOrFail($id);
        $sDocumentos = SDocumento::pluck('descripcion','id')->all();

        return view('files_s_documentos.edit', compact('filesSDocumento','sDocumentos'));
    }

    /**
     * Update the specified files s documento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\FilesSDocumentosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, FilesSDocumentosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $filesSDocumento = FilesSDocumento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $filesSDocumento->update($data);

            return redirect()->route('files_s_documentos.files_s_documento.index')
                             ->with('success_message', trans('files_s_documentos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_s_documentos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified files s documento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $filesSDocumento = FilesSDocumento::findOrFail($id);
            Storage::disk('files_s_documento')->delete($filesSDocumento->file_path);
            $filesSDocumento->delete();
            
            return redirect()->route('s_documentos.s_documento.index')
                             ->with('success_message', trans('files_s_documentos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_s_documentos.unexpected_error')]);
        }
    }

    public function cargaArchivo(Request $request) {
        //dd($request);
        $r=false;
        try{
            if ($request->hasFile('file')) {
                
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $nombre = $file->getClientOriginalName();
                $nombre=date('dmYHmi')."_".str_replace(' ','_',$nombre);
                $r = Storage::disk('files_s_documento')->put($nombre, \File::get($file));
                //dd($r);
                $data['descripcion']=$request->get('descripcion');
                $data['s_documento_id']=$request->get("s_documento");
                $data['file_path']=$nombre;
                //dd($data);
                $file= FilesSDocumento::create($data);
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

    public function getFiles(Request $request){
        //dd($request->all());
        $lineas=FilesSDocumento::select('id', 'descripcion', 'file_path')
                                ->where('s_documento_id', '=', $request->get('s_documento'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'descripcion'=>$l->descripcion,
                                         'file_path'=>asset('/storage/files_s_documento/'.$l->file_path),
                                         'file_name'=>$l->file_path
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }
}
