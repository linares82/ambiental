<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AArchivo;
use App\Models\FilesAArchivo;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilesAArchivosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Storage;

class FilesAArchivosController extends Controller
{

    /**
     * Display a listing of the files a archivos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=FilesAArchivo::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$filesAArchivos = $r->with('aarchivo','user')->paginate(25);
		//$filesAArchivos = FilesAArchivo::with('aarchivo','user')->paginate(25);

        return view('files_a_archivos.index', compact('filesAArchivos'));
    }

    /**
     * Show the form for creating a new files a archivo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $aArchivos = AArchivo::pluck('descripcion','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('files_a_archivos.create', compact('aArchivos','users','users'));
    }

    /**
     * Store a new files a archivo in the storage.
     *
     * @param App\Http\Requests\FilesAArchivosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(FilesAArchivosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
		$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            FilesAArchivo::create($data);

            return redirect()->route('files_a_archivos.files_a_archivo.index')
                             ->with('success_message', trans('files_a_archivos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_a_archivos.unexpected_error')]);
        }
    }

    /**
     * Display the specified files a archivo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $filesAArchivo = FilesAArchivo::with('aarchivo','user')->findOrFail($id);

        return view('files_a_archivos.show', compact('filesAArchivo'));
    }

    /**
     * Show the form for editing the specified files a archivo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $filesAArchivo = FilesAArchivo::findOrFail($id);
        $aArchivos = AArchivo::pluck('descripcion','id')->all();
$users = User::pluck('name','id')->all();

        return view('files_a_archivos.edit', compact('filesAArchivo','aArchivos','users','users'));
    }

    /**
     * Update the specified files a archivo in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\FilesAArchivosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, FilesAArchivosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $filesAArchivo = FilesAArchivo::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $filesAArchivo->update($data);

            return redirect()->route('files_a_archivos.files_a_archivo.index')
                             ->with('success_message', trans('files_a_archivos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_a_archivos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified files a archivo from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $filesAArchivo = FilesAArchivo::findOrFail($id);
            Storage::disk('files_a_archivo')->delete($filesAArchivo->file_path);
            $filesAArchivo->delete();

            return redirect()->route('a_archivos.files_a_archivo.index')
                             ->with('success_message', trans('a_archivos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_a_archivos.unexpected_error')]);
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
                $r = Storage::disk('files_a_archivo')->put($nombre, \File::get($file));
                //dd($r);
                $data['documento']=$request->get('documento');
                $data['a_archivo_id']=$request->get("a_archivo");
                $data['archivo']=$nombre;
                $data['usu_mod_id']=Auth::user()->id;
                $data['usu_alta_id']=Auth::user()->id;
                //dd($data);
                $file= FilesAArchivo::create($data);
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
        $lineas=FilesAArchivo::select('id', 'documento', 'archivo')
                                ->where('a_archivo_id', '=', $request->get('a_archivo'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'documento'=>$l->documento,
                                         'file_path'=>asset('/storage/files_a_archivo/'.$l->archivo),
                                         'file_name'=>$l->archivo
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }


}
