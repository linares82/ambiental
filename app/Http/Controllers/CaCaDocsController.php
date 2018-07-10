<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaCaDoc;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaCaDocsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaCaDocsController extends Controller
{

    /**
     * Display a listing of the ca ca docs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaCaDoc::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                
		if(isset($input['doc']) and $input['doc']<>null){
			$r->where('doc', 'like', '%'.$input['doc'].'%');
		}
		$caCaDocs = $r->with('user')->paginate(25);
		//$caCaDocs = CaCaDoc::with('user')->paginate(25);

        return view('ca_ca_docs.index', compact('caCaDocs'));
    }

    /**
     * Show the form for creating a new ca ca doc.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('ca_ca_docs.create', compact('users','users'));
    }

    /**
     * Store a new ca ca doc in the storage.
     *
     * @param App\Http\Requests\CaCaDocsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaCaDocsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            CaCaDoc::create($data);

            return redirect()->route('ca_ca_docs.ca_ca_doc.index')
                             ->with('success_message', trans('ca_ca_docs.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_ca_docs.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca ca doc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caCaDoc = CaCaDoc::with('user')->findOrFail($id);

        return view('ca_ca_docs.show', compact('caCaDoc'));
    }

    /**
     * Show the form for editing the specified ca ca doc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caCaDoc = CaCaDoc::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('ca_ca_docs.edit', compact('caCaDoc','users','users'));
    }

    /**
     * Update the specified ca ca doc in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaCaDocsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaCaDocsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caCaDoc = CaCaDoc::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caCaDoc->update($data);

            return redirect()->route('ca_ca_docs.ca_ca_doc.index')
                             ->with('success_message', trans('ca_ca_docs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_ca_docs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca ca doc from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caCaDoc = CaCaDoc::findOrFail($id);
            $caCaDoc->delete();

            return redirect()->route('ca_ca_docs.ca_ca_doc.index')
                             ->with('success_message', trans('ca_ca_docs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_ca_docs.unexpected_error')]);
        }
    }



}
