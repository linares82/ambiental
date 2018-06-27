<?php

namespace App\Http\Controllers;

use App\Models\SRegistro;
use App\Models\FilesSRegistro;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilesSRegistrosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Storage;

class FilesSRegistrosController extends Controller
{

    /**
     * Display a listing of the files s registros.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=FilesSRegistro::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$filesSRegistros = $r->with('sregistro')->paginate(25);
		//$filesSRegistros = FilesSRegistro::with('sregistro')->paginate(25);

        return view('files_s_registros.index', compact('filesSRegistros'));
    }

    /**
     * Show the form for creating a new files s registro.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $sRegistros = SRegistro::pluck('detalle','id')->all();
        
        return view('files_s_registros.create', compact('sRegistros'));
    }

    /**
     * Store a new files s registro in the storage.
     *
     * @param App\Http\Requests\FilesSRegistrosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(FilesSRegistrosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            FilesSRegistro::create($data);

            return redirect()->route('files_s_registros.files_s_registro.index')
                             ->with('success_message', trans('files_s_registros.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_s_registros.unexpected_error')]);
        }
    }

    /**
     * Display the specified files s registro.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $filesSRegistro = FilesSRegistro::with('sregistro')->findOrFail($id);

        return view('files_s_registros.show', compact('filesSRegistro'));
    }

    /**
     * Show the form for editing the specified files s registro.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $filesSRegistro = FilesSRegistro::findOrFail($id);
        $sRegistros = SRegistro::pluck('detalle','id')->all();

        return view('files_s_registros.edit', compact('filesSRegistro','sRegistros'));
    }

    /**
     * Update the specified files s registro in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\FilesSRegistrosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, FilesSRegistrosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $filesSRegistro = FilesSRegistro::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $filesSRegistro->update($data);

            return redirect()->route('files_s_registros.files_s_registro.index')
                             ->with('success_message', trans('files_s_registros.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_s_registros.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified files s registro from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $filesSRegistro = FilesSRegistro::findOrFail($id);
            Storage::disk('files_s_registro')->delete($filesSRegistro->file_path);
            $filesSRegistro->delete();

            return redirect()->route('s_registros.s_registro.index')
                             ->with('success_message', trans('files_s_registros.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_s_registros.unexpected_error')]);
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
                $r = Storage::disk('files_s_registro')->put($nombre, \File::get($file));
                //dd($r);
                $data['descripcion']=$request->get('descripcion');
                $data['s_registro_id']=$request->get("s_registro");
                $data['file_path']=$nombre;
                //dd($data);
                $file= FilesSRegistro::create($data);
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
        $lineas=FilesSRegistro::select('id', 'descripcion', 'file_path')
                                ->where('s_registro_id', '=', $request->get('s_registro'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'descripcion'=>$l->descripcion,
                                         'file_path'=>asset('/storage/files_s_registro/'.$l->file_path),
                                         'file_name'=>$l->file_path
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }

}
