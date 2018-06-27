<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entity;
use App\Models\CaAaDoc;
use App\Models\CaMaterial;
use App\Models\CaCategoria;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaAaDocsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaAaDocsController extends Controller
{

    /**
     * Display a listing of the ca aa docs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaAaDoc::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$caAaDocs = $r->with('camaterial','cacategoria','user','entity')->paginate(25);
		//$caAaDocs = CaAaDoc::with('camaterial','cacategoria','user','entity')->paginate(25);

        return view('ca_aa_docs.index', compact('caAaDocs'));
    }

    /**
     * Show the form for creating a new ca aa doc.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caMaterials = CaMaterial::pluck('material','id')->all();
$caCategorias = CaCategoria::pluck('categoria','id')->all();
$users = User::pluck('name','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
        
        return view('ca_aa_docs.create', compact('caMaterials','caCategorias','users','users','entities'));
    }

    /**
     * Store a new ca aa doc in the storage.
     *
     * @param App\Http\Requests\CaAaDocsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaAaDocsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaAaDoc::create($data);

            return redirect()->route('ca_aa_docs.ca_aa_doc.index')
                             ->with('success_message', trans('ca_aa_docs.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_aa_docs.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca aa doc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caAaDoc = CaAaDoc::with('camaterial','cacategoria','user','entity')->findOrFail($id);

        return view('ca_aa_docs.show', compact('caAaDoc'));
    }

    /**
     * Show the form for editing the specified ca aa doc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caAaDoc = CaAaDoc::findOrFail($id);
        $caMaterials = CaMaterial::pluck('material','id')->all();
$caCategorias = CaCategoria::pluck('categoria','id')->all();
$users = User::pluck('name','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();

        return view('ca_aa_docs.edit', compact('caAaDoc','caMaterials','caCategorias','users','users','entities'));
    }

    /**
     * Update the specified ca aa doc in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaAaDocsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaAaDocsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caAaDoc = CaAaDoc::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caAaDoc->update($data);

            return redirect()->route('ca_aa_docs.ca_aa_doc.index')
                             ->with('success_message', trans('ca_aa_docs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_aa_docs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca aa doc from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caAaDoc = CaAaDoc::findOrFail($id);
            $caAaDoc->delete();

            return redirect()->route('ca_aa_docs.ca_aa_doc.index')
                             ->with('success_message', trans('ca_aa_docs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_aa_docs.unexpected_error')]);
        }
    }



}
