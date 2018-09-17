<?php

namespace App\Http\Controllers;

use App\Models\Meses;
use App\Models\User;
use App\Models\Entity;
use App\Models\RevDocumental;
use App\Http\Controllers\Controller;
use App\Http\Requests\RevDocumentalsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class RevDocumentalsController extends Controller
{

    /**
     * Display a listing of the rev documentals.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=RevDocumental::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['anio']) and $input['anio']<>null){
			$r->where('anio', '=', $input['anio']);
		}
                if(isset($input['mes_id']) and $input['mes_id']<>null){
			$r->where('mes_id', '=', $input['mes_id']);
		}
                $entity=Entity::find(Auth::user()->entity_id);
                if (Auth::user()->canDo('filtro_entity') or $entity->filtred_by_entity==1) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                
                $mese = Meses::pluck('mes','id')->all();
		$revDocumentals = $r->with('entity','mese','user')->paginate(25);
		//$revDocumentals = RevDocumental::with('entity','mese','user')->paginate(25);

        return view('rev_documentals.index', compact('revDocumentals','mese'));
    }

    /**
     * Show the form for creating a new rev documental.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $entities = Entity::pluck('rzon_social','id')->all();
$mese = Meses::pluck('mes','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('rev_documentals.create', compact('entities','mese','users','users'));
    }

    /**
     * Store a new rev documental in the storage.
     *
     * @param App\Http\Requests\RevDocumentalsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RevDocumentalsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            RevDocumental::create($data);

            return redirect()->route('rev_documentals.rev_documental.index')
                             ->with('success_message', trans('rev_documentals.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_documentals.unexpected_error')]);
        }
    }

    /**
     * Display the specified rev documental.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $revDocumental = RevDocumental::with('entity','mese','user')->findOrFail($id);

        return view('rev_documentals.show', compact('revDocumental'));
    }

    /**
     * Show the form for editing the specified rev documental.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $revDocumental = RevDocumental::findOrFail($id);
        $entities = Entity::pluck('rzon_social','id')->all();
$mese = Meses::pluck('mes','id')->all();
$users = User::pluck('name','id')->all();

        return view('rev_documentals.edit', compact('revDocumental','entities','mese','users','users'));
    }

    /**
     * Update the specified rev documental in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RevDocumentalsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RevDocumentalsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $revDocumental = RevDocumental::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $revDocumental->update($data);

            return redirect()->route('rev_documentals.rev_documental.index')
                             ->with('success_message', trans('rev_documentals.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_documentals.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified rev documental from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $revDocumental = RevDocumental::findOrFail($id);
            $revDocumental->delete();

            return redirect()->route('rev_documentals.rev_documental.index')
                             ->with('success_message', trans('rev_documentals.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_documentals.unexpected_error')]);
        }
    }



}
