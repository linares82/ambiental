<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsCatDoc;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsCatDocsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsCatDocsController extends Controller
{

    /**
     * Display a listing of the cs cat docs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsCatDoc::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['cat_doc']) and $input['cat_doc']<>null){
			$r->where('cat_doc', 'like', '%'.$input['cat_doc'].'%');
		}
		$csCatDocs = $r->with('user')->paginate(25);
		//$csCatDocs = CsCatDoc::with('user')->paginate(25);

        return view('cs_cat_docs.index', compact('csCatDocs'));
    }

    /**
     * Show the form for creating a new cs cat doc.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('cs_cat_docs.create', compact('users','users'));
    }

    /**
     * Store a new cs cat doc in the storage.
     *
     * @param App\Http\Requests\CsCatDocsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsCatDocsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsCatDoc::create($data);

            return redirect()->route('cs_cat_docs.cs_cat_doc.index')
                             ->with('success_message', trans('cs_cat_docs.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_cat_docs.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs cat doc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csCatDoc = CsCatDoc::with('user')->findOrFail($id);

        return view('cs_cat_docs.show', compact('csCatDoc'));
    }

    /**
     * Show the form for editing the specified cs cat doc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csCatDoc = CsCatDoc::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('cs_cat_docs.edit', compact('csCatDoc','users','users'));
    }

    /**
     * Update the specified cs cat doc in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsCatDocsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsCatDocsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csCatDoc = CsCatDoc::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csCatDoc->update($data);

            return redirect()->route('cs_cat_docs.cs_cat_doc.index')
                             ->with('success_message', trans('cs_cat_docs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_cat_docs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs cat doc from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csCatDoc = CsCatDoc::findOrFail($id);
            $csCatDoc->delete();

            return redirect()->route('cs_cat_docs.cs_cat_doc.index')
                             ->with('success_message', trans('cs_cat_docs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_cat_docs.unexpected_error')]);
        }
    }



}
