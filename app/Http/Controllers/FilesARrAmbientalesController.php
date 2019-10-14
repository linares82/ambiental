<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ARrAmbientale;
use App\Models\FilesARrAmbientale;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilesARrAmbientalesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Storage;

class FilesARrAmbientalesController extends Controller
{

    /**
     * Display a listing of the files a rr ambientales.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=FilesARrAmbientale::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$filesARrAmbientales = $r->with('arrambientale','user')->paginate(25);
		//$filesARrAmbientales = FilesARrAmbientale::with('arrambientale','user')->paginate(25);

        return view('files_a_rr_ambientales.index', compact('filesARrAmbientales'));
    }

    /**
     * Show the form for creating a new files a rr ambientale.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $aRrAmbientales = ARrAmbientale::pluck('descripcion','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('files_a_rr_ambientales.create', compact('aRrAmbientales','users','users'));
    }

    /**
     * Store a new files a rr ambientale in the storage.
     *
     * @param App\Http\Requests\FilesARrAmbientalesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(FilesARrAmbientalesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            FilesARrAmbientale::create($data);

            return redirect()->route('files_a_rr_ambientales.files_a_rr_ambientale.index')
                             ->with('success_message', trans('files_a_rr_ambientales.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_a_rr_ambientales.unexpected_error')]);
        }
    }

    /**
     * Display the specified files a rr ambientale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $filesARrAmbientale = FilesARrAmbientale::with('arrambientale','user')->findOrFail($id);

        return view('files_a_rr_ambientales.show', compact('filesARrAmbientale'));
    }

    /**
     * Show the form for editing the specified files a rr ambientale.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $filesARrAmbientale = FilesARrAmbientale::findOrFail($id);
        $aRrAmbientales = ARrAmbientale::pluck('descripcion','id')->all();
$users = User::pluck('name','id')->all();

        return view('files_a_rr_ambientales.edit', compact('filesARrAmbientale','aRrAmbientales','users','users'));
    }

    /**
     * Update the specified files a rr ambientale in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\FilesARrAmbientalesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, FilesARrAmbientalesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $filesARrAmbientale = FilesARrAmbientale::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $filesARrAmbientale->update($data);

            return redirect()->route('files_a_rr_ambientales.files_a_rr_ambientale.index')
                             ->with('success_message', trans('files_a_rr_ambientales.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_a_rr_ambientales.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified files a rr ambientale from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $filesARrAmbientale = FilesARrAmbientale::findOrFail($id);
            Storage::disk('files_a_rr_ambientale')->delete($filesARrAmbientale->file_path);
            $filesARrAmbientale->delete();

            return redirect()->route('a_rr_ambientales.a_rr_ambientale.index')
                             ->with('success_message', trans('files_a_rr_ambientales.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_a_rr_ambientales.unexpected_error')]);
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
                $r = Storage::disk('files_a_rr_ambientale')->put($nombre, \File::get($file));
                //dd($r);
                $data['descripcion']=$request->get('descripcion');
                $data['a_rr_ambiental_id']=$request->get("a_rr_ambiental_id");
                $data['file_path']=$nombre;
                $data['usu_mod_id']=Auth::user()->id;
                $data['usu_alta_id']=Auth::user()->id;
                //dd($data);
                $file= FilesARrAmbientale::create($data);
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
        $lineas= FilesARrAmbientale::select('id', 'descripcion', 'file_path')
                                ->where('a_rr_ambiental_id', '=', $request->get('a_rr_ambientale'))
                                ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array(
                                         'id'=>$l->id,
                                         'descripcion'=>$l->descripcion,
                                         'file_path'=>asset('/storage/files_a_rr_ambientale/'.$l->file_path),
                                         'file_name'=>$l->file_path
                                         ));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }


}
