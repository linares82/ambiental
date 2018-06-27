<?php

namespace App\Http\Controllers;

use App\Models\RevDocumentalLn;
use App\Models\FilesRevDocumentalLn;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilesRevDocumentalLnsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use Storage;

class FilesRevDocumentalLnsController extends Controller
{

    /**
     * Display a listing of the files rev documental lns.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=FilesRevDocumentalLn::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$filesRevDocumentalLns = $r->with('revdocumentalln')->paginate(25);
		//$filesRevDocumentalLns = FilesRevDocumentalLn::with('revdocumentalln')->paginate(25);

        return view('files_rev_documental_lns.index', compact('filesRevDocumentalLns'));
    }

    /**
     * Show the form for creating a new files rev documental ln.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $revDocumentalLns = RevDocumentalLn::pluck('dias_advertencia1','id')->all();
        
        return view('files_rev_documental_lns.create', compact('revDocumentalLns'));
    }

    /**
     * Store a new files rev documental ln in the storage.
     *
     * @param App\Http\Requests\FilesRevDocumentalLnsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(FilesRevDocumentalLnsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            FilesRevDocumentalLn::create($data);

            return redirect()->route('files_rev_documental_lns.files_rev_documental_ln.index')
                             ->with('success_message', trans('files_rev_documental_lns.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_rev_documental_lns.unexpected_error')]);
        }
    }

    /**
     * Display the specified files rev documental ln.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $filesRevDocumentalLn = FilesRevDocumentalLn::with('revdocumentalln')->findOrFail($id);

        return view('files_rev_documental_lns.show', compact('filesRevDocumentalLn'));
    }

    /**
     * Show the form for editing the specified files rev documental ln.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $filesRevDocumentalLn = FilesRevDocumentalLn::findOrFail($id);
        $revDocumentalLns = RevDocumentalLn::pluck('dias_advertencia1','id')->all();
        
        return view('files_rev_documental_lns.edit', compact('filesRevDocumentalLn','revDocumentalLns'));
    }

    /**
     * Update the specified files rev documental ln in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\FilesRevDocumentalLnsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, FilesRevDocumentalLnsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $filesRevDocumentalLn = FilesRevDocumentalLn::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $filesRevDocumentalLn->update($data);

            return redirect()->route('files_rev_documental_lns.files_rev_documental_ln.index')
                             ->with('success_message', trans('files_rev_documental_lns.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_rev_documental_lns.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified files rev documental ln from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        //dd(fil);
        try {
            $filesRevDocumentalLn = FilesRevDocumentalLn::findOrFail($id);
            Storage::disk('files_rev_documental_ln')->delete($filesRevDocumentalLn->file_path);
            $filesRevDocumentalLn->delete();

            return redirect()->route('rev_documental_lns.rev_documental_ln.edit',$filesRevDocumentalLn->rev_documental_ln_id)
                             ->with('success_message', trans('files_rev_documental_lns.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('files_rev_documental_lns.unexpected_error')]);
        }
    }

    public function cargaArchivo(Request $request) {
        //dd($request);
        $r=false;
        try{
            if ($request->hasFile('file')) {
                //dd("request");
                $file = $request->file('file');
                $extension = $file->getClientOriginalExtension();
                $nombre = $file->getClientOriginalName();
                $nombre=date('dmYHmi')."_".str_replace(' ','_',$nombre);
                $r = Storage::disk('files_rev_documental_ln')->put($nombre, \File::get($file));
                //dd($r);
                $data['descripcion']=$request->get('descripcion');
                $data['rev_documental_ln_id']=$request->get("files_rev_documental_ln");
                $data['file_path']=$nombre;
                //dd($data);
                $file= FilesRevDocumentalLn::create($data);
                //dd("copia");
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

}
