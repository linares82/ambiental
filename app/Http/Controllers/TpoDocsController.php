<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TpoDoc;
use App\Http\Controllers\Controller;
use App\Http\Requests\TpoDocsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class TpoDocsController extends Controller
{

    /**
     * Display a listing of the tpo docs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=TpoDoc::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$tpoDocs = $r->with('user')->paginate(25);
		//$tpoDocs = TpoDoc::with('user')->paginate(25);

        return view('tpo_docs.index', compact('tpoDocs'));
    }

    /**
     * Show the form for creating a new tpo doc.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('tpo_docs.create', compact('users','users'));
    }

    /**
     * Store a new tpo doc in the storage.
     *
     * @param App\Http\Requests\TpoDocsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(TpoDocsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            TpoDoc::create($data);

            return redirect()->route('tpo_docs.tpo_doc.index')
                             ->with('success_message', trans('tpo_docs.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tpo_docs.unexpected_error')]);
        }
    }

    /**
     * Display the specified tpo doc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $tpoDoc = TpoDoc::with('user')->findOrFail($id);

        return view('tpo_docs.show', compact('tpoDoc'));
    }

    /**
     * Show the form for editing the specified tpo doc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $tpoDoc = TpoDoc::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('tpo_docs.edit', compact('tpoDoc','users','users'));
    }

    /**
     * Update the specified tpo doc in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\TpoDocsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, TpoDocsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $tpoDoc = TpoDoc::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $tpoDoc->update($data);

            return redirect()->route('tpo_docs.tpo_doc.index')
                             ->with('success_message', trans('tpo_docs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tpo_docs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified tpo doc from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $tpoDoc = TpoDoc::findOrFail($id);
            $tpoDoc->delete();

            return redirect()->route('tpo_docs.tpo_doc.index')
                             ->with('success_message', trans('tpo_docs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('tpo_docs.unexpected_error')]);
        }
    }



}
