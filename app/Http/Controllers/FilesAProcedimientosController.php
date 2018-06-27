<?php

namespace App\Http\Controllers;

use App\Models\AProcedimiento;
use App\Models\FilesAProcedimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilesAProcedimientosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Storage;

class FilesAProcedimientosController extends Controller
{

    /**
     * Display a listing of the files a procedimientos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=FilesAProcedimiento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$filesAProcedimientos = $r->with('aprocedimiento')->paginate(25);
		//$filesAProcedimientos = FilesAProcedimiento::with('aprocedimiento')->paginate(25);

        return view('files_a_procedimientos.index', compact('filesAProcedimientos'));
    }

    /**
     * Show the form for creating a new files a procedimiento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $aProcedimientos = AProcedimiento::pluck('descripcion','id')->all();
        
        return view('files_a_procedimientos.create', compact('aProcedimientos'));
    }

    /**
     * Store a new files a procedimiento in the storage.
     *
     * @param App\Http\Requests\FilesAProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(FilesAProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            FilesAProcedimiento::create($data);

            return redirect()->route('files_a_procedimientos.files_a_procedimiento.index')
                             ->with('success_message', trans('files_a_procedimientos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_a_procedimientos.unexpected_error')]);
        }
    }

    /**
     * Display the specified files a procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $filesAProcedimiento = FilesAProcedimiento::with('aprocedimiento')->findOrFail($id);

        return view('files_a_procedimientos.show', compact('filesAProcedimiento'));
    }

    /**
     * Show the form for editing the specified files a procedimiento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $filesAProcedimiento = FilesAProcedimiento::findOrFail($id);
        $aProcedimientos = AProcedimiento::pluck('descripcion','id')->all();

        return view('files_a_procedimientos.edit', compact('filesAProcedimiento','aProcedimientos'));
    }

    /**
     * Update the specified files a procedimiento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\FilesAProcedimientosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, FilesAProcedimientosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $filesAProcedimiento = FilesAProcedimiento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $filesAProcedimiento->update($data);

            return redirect()->route('files_a_procedimientos.files_a_procedimiento.index')
                             ->with('success_message', trans('files_a_procedimientos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_a_procedimientos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified files a procedimiento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $filesAProcedimiento = FilesAProcedimiento::findOrFail($id);
            Storage::disk('files_a_procedimiento')->delete($filesAProcedimiento->file_path);
            $filesAProcedimiento->delete();

            return redirect()->route('a_procedimientos.a_procedimiento.index')
                             ->with('success_message', trans('files_a_procedimientos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_a_procedimientos.unexpected_error')]);
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
                $r = Storage::disk('files_a_procedimiento')->put($nombre, \File::get($file));
                //dd($r);
                $data['descripcion']=$request->get('descripcion');
                $data['a_procedimiento_id']=$request->get("a_procedimiento");
                $data['file_path']=$nombre;
                //dd($data);
                $file= FilesAProcedimiento::create($data);
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
        $lineas=FilesAProcedimiento::select('id', 'descripcion', 'file_path')
                                ->where('a_procedimiento_id', '=', $request->get('a_procedimiento'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'descripcion'=>$l->descripcion,
                                         'file_path'=>asset('/storage/files_a_procedimiento/'.$l->file_path),
                                         'file_name'=>$l->file_path
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }


}
