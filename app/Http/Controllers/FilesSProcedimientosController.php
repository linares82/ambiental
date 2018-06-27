<?php

namespace App\Http\Controllers;

use App\Models\SProcedimiento;
use App\Models\FilesSProcedimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilesSProcedimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Storage;

class FilesSProcedimientosController extends Controller
{

    /**
     * Display a listing of the files s procedimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=FilesSProcedimiento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$filesSProcedimientos = $r->with('sprocedimiento')->paginate(25);
		//$filesSProcedimientos = FilesSProcedimiento::with('sprocedimiento')->paginate(25);

        return view('files_s_procedimientos.index', compact('filesSProcedimientos'));
    }

    /**
     * Show the form for creating a new files s procedimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $sProcedimientos = SProcedimiento::pluck('descripcion','id')->all();
        
        return view('files_s_procedimientos.create', compact('sProcedimientos'));
    }

    /**
     * Store a new files s procedimiento in the storage.
     *
     * @param App\Http\Requests\FilesSProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(FilesSProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            FilesSProcedimiento::create($data);

            return redirect()->route('files_s_procedimientos.files_s_procedimiento.index')
                             ->with('success_message', trans('files_s_procedimientos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_s_procedimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified files s procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $filesSProcedimiento = FilesSProcedimiento::with('sprocedimiento')->findOrFail($id);

        return view('files_s_procedimientos.show', compact('filesSProcedimiento'));
    }

    /**
     * Show the form for editing the specified files s procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $filesSProcedimiento = FilesSProcedimiento::findOrFail($id);
        $sProcedimientos = SProcedimiento::pluck('descripcion','id')->all();

        return view('files_s_procedimientos.edit', compact('filesSProcedimiento','sProcedimientos'));
    }

    /**
     * Update the specified files s procedimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\FilesSProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, FilesSProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $filesSProcedimiento = FilesSProcedimiento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $filesSProcedimiento->update($data);

            return redirect()->route('files_s_procedimientos.files_s_procedimiento.index')
                             ->with('success_message', trans('files_s_procedimientos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_s_procedimientos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified files s procedimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $filesSProcedimiento = FilesSProcedimiento::findOrFail($id);
            Storage::disk('files_s_procedimiento')->delete($filesSProcedimiento->file_path);
            $filesSProcedimiento->delete();

            return redirect()->route('s_procedimientos.s_procedimiento.index')
                             ->with('success_message', trans('files_s_procedimientos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_s_procedimientos.unexpected_error')]);
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
                $r = Storage::disk('files_s_procedimiento')->put($nombre, \File::get($file));
                //dd($r);
                $data['descripcion']=$request->get('descripcion');
                $data['s_procedimiento_id']=$request->get("s_procedimiento");
                $data['file_path']=$nombre;
                //dd($data);
                $file= FilesSProcedimiento::create($data);
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
        $lineas=FilesSProcedimiento::select('id', 'descripcion', 'file_path')
                                ->where('s_procedimiento_id', '=', $request->get('s_procedimiento'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'descripcion'=>$l->descripcion,
                                         'file_path'=>asset('/storage/files_s_procedimiento/'.$l->file_path),
                                         'file_name'=>$l->file_path
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }

}
