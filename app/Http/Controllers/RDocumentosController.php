<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TpoDoc;
use App\Models\RDocumento;
use App\Http\Controllers\Controller;
use App\Http\Requests\RDocumentosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class RDocumentosController extends Controller
{

    /**
     * Display a listing of the r documentos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=RDocumento::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$rDocumentos = $r->with('tpodoc')->paginate(25);
		//$rDocumentos = RDocumento::with('tpodoc')->paginate(25);

        return view('r_documentos.index', compact('rDocumentos'));
    }

    /**
     * Show the form for creating a new r documento.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $tpoDocs = TpoDoc::pluck('tpo_doc','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('r_documentos.create', compact('tpoDocs','users','users'));
    }

    /**
     * Store a new r documento in the storage.
     *
     * @param App\Http\Requests\RDocumentosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RDocumentosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            RDocumento::create($data);

            return redirect()->route('r_documentos.r_documento.index')
                             ->with('success_message', trans('r_documentos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('r_documentos.unexpected_error')]);
        }
    }

    /**
     * Display the specified r documento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $rDocumento = RDocumento::with('tpodoc','user')->findOrFail($id);

        return view('r_documentos.show', compact('rDocumento'));
    }

    /**
     * Show the form for editing the specified r documento.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $rDocumento = RDocumento::findOrFail($id);
        $tpoDocs = TpoDoc::pluck('tpo_doc','id')->all();
$users = User::pluck('name','id')->all();

        return view('r_documentos.edit', compact('rDocumento','tpoDocs','users','users'));
    }

    /**
     * Update the specified r documento in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RDocumentosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RDocumentosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $rDocumento = RDocumento::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $rDocumento->update($data);

            return redirect()->route('r_documentos.r_documento.index')
                             ->with('success_message', trans('r_documentos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('r_documentos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified r documento from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $rDocumento = RDocumento::findOrFail($id);
            $rDocumento->delete();

            return redirect()->route('r_documentos.r_documento.index')
                             ->with('success_message', trans('r_documentos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('r_documentos.unexpected_error')]);
        }
    }



}
