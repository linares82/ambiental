<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsNorma;
use App\Models\FilesCsNorma;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilesCsNormasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Storage;

class FilesCsNormasController extends Controller
{

    /**
     * Display a listing of the files cs normas.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=FilesCsNorma::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$filesCsNormas = $r->with('csnorma','user')->paginate(25);
		//$filesCsNormas = FilesCsNorma::with('csnorma','user')->paginate(25);

        return view('files_cs_normas.index', compact('filesCsNormas'));
    }

    /**
     * Show the form for creating a new files cs norma.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $csNormas = CsNorma::pluck('norma','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('files_cs_normas.create', compact('csNormas','users','users'));
    }

    /**
     * Store a new files cs norma in the storage.
     *
     * @param App\Http\Requests\FilesCsNormasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(FilesCsNormasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            FilesCsNorma::create($data);

            return redirect()->route('files_cs_normas.files_cs_norma.index')
                             ->with('success_message', trans('files_cs_normas.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_cs_normas.unexpected_error')]);
        }
    }

    /**
     * Display the specified files cs norma.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $filesCsNorma = FilesCsNorma::with('csnorma','user')->findOrFail($id);

        return view('files_cs_normas.show', compact('filesCsNorma'));
    }

    /**
     * Show the form for editing the specified files cs norma.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $filesCsNorma = FilesCsNorma::findOrFail($id);
        $csNormas = CsNorma::pluck('norma','id')->all();
$users = User::pluck('name','id')->all();

        return view('files_cs_normas.edit', compact('filesCsNorma','csNormas','users','users'));
    }

    /**
     * Update the specified files cs norma in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\FilesCsNormasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, FilesCsNormasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $filesCsNorma = FilesCsNorma::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $filesCsNorma->update($data);

            return redirect()->route('files_cs_normas.files_cs_norma.index')
                             ->with('success_message', trans('files_cs_normas.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_cs_normas.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified files cs norma from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $filesCsNorma = FilesCsNorma::findOrFail($id);
            Storage::disk('files_cs_norma')->delete($filesCsNorma->file_path);
            $filesCsNorma->delete();

            return redirect()->route('cs_normas.cs_norma.index')
                             ->with('success_message', trans('files_cs_normas.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_cs_normas.unexpected_error')]);
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
                $r = Storage::disk('files_cs_norma')->put($nombre, \File::get($file));
                //dd($r);
                $data['descripcion']=$request->get('descripcion');
                $data['cs_norma_id']=$request->get("cs_norma");
                $data['file_path']=$nombre;
                //dd($data);
                $file= FilesCsNorma::create($data);
                //Log::info($file);
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
        $lineas=FilesCsnorma::select('id', 'descripcion', 'file_path')
                                ->where('cs_norma_id', '=', $request->get('cs_norma'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'descripcion'=>$l->descripcion,
                                         'file_path'=>asset('/storage/files_cs_norma/'.$l->file_path),
                                         'file_name'=>$l->file_path
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }

}
