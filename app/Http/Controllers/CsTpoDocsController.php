<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsTpoDoc;
use App\Models\CsTpoProcedimiento;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsTpoDocsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsTpoDocsController extends Controller
{

    /**
     * Display a listing of the cs tpo docs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsTpoDoc::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['tpo_procedimiento_id']) and $input['tpo_procedimiento_id']<>null){
			$r->where('tpo_procedimiento_id', '=', $input['tpo_procedimiento_id']);
		}
		if(isset($input['tpo_doc']) and $input['tpo_doc']<>""){
			$r->where('tpo_doc', 'like', '%'.$input['tpo_doc'].'%');
		}
                $csTpoProcedimientos = CsTpoProcedimiento::pluck('tpo_procedimiento','id')->all();
		$csTpoDocs = $r->with('cstpoprocedimiento','user')->paginate(25);
		//$csTpoDocs = CsTpoDoc::with('cstpoprocedimiento','user')->paginate(25);

        return view('cs_tpo_docs.index', compact('csTpoDocs','csTpoProcedimientos'));
    }

    /**
     * Show the form for creating a new cs tpo doc.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $csTpoProcedimientos = CsTpoProcedimiento::pluck('tpo_procedimiento','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('cs_tpo_docs.create', compact('csTpoProcedimientos','users','users'));
    }

    /**
     * Store a new cs tpo doc in the storage.
     *
     * @param App\Http\Requests\CsTpoDocsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsTpoDocsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsTpoDoc::create($data);

            return redirect()->route('cs_tpo_docs.cs_tpo_doc.index')
                             ->with('success_message', trans('cs_tpo_docs.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_docs.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs tpo doc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csTpoDoc = CsTpoDoc::with('cstpoprocedimiento','user')->findOrFail($id);

        return view('cs_tpo_docs.show', compact('csTpoDoc'));
    }

    /**
     * Show the form for editing the specified cs tpo doc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csTpoDoc = CsTpoDoc::findOrFail($id);
        $csTpoProcedimientos = CsTpoProcedimiento::pluck('tpo_procedimiento','id')->all();
$users = User::pluck('name','id')->all();

        return view('cs_tpo_docs.edit', compact('csTpoDoc','csTpoProcedimientos','users','users'));
    }

    /**
     * Update the specified cs tpo doc in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsTpoDocsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsTpoDocsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csTpoDoc = CsTpoDoc::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csTpoDoc->update($data);

            return redirect()->route('cs_tpo_docs.cs_tpo_doc.index')
                             ->with('success_message', trans('cs_tpo_docs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_docs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs tpo doc from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csTpoDoc = CsTpoDoc::findOrFail($id);
            $csTpoDoc->delete();

            return redirect()->route('cs_tpo_docs.cs_tpo_doc.index')
                             ->with('success_message', trans('cs_tpo_docs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_docs.unexpected_error')]);
        }
    }



}
