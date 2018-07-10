<?php

namespace App\Http\Controllers;

use App\Models\Meses;
use App\Models\User;
use App\Models\Entity;
use App\Models\RevRequisito;
use App\Http\Controllers\Controller;
use App\Http\Requests\RevRequisitosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class RevRequisitosController extends Controller
{

    /**
     * Display a listing of the rev requisitos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=RevRequisito::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['anio']) and $input['anio']<>null){
			$r->where('anio', '=', $input['anio']);
		}
                if(isset($input['mes_id']) and $input['mes_id']<>null){
			$r->where('mes_id', '=', $input['mes_id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                $mese = Meses::pluck('mes','id')->all();
		$revRequisitos = $r->with('entity','meses','user')->paginate(25);
		//$revRequisitos = RevRequisito::with('entity','mese','user')->paginate(25);

        return view('rev_requisitos.index', compact('revRequisitos','mese'));
    }

    /**
     * Show the form for creating a new rev requisito.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $entities = Entity::pluck('rzon_social','id')->all();
        $mese = Meses::pluck('mes','id')->all();
        $users = User::pluck('name','id')->all();
        
        return view('rev_requisitos.create', compact('entities','mese','users','users'));
    }

    /**
     * Store a new rev requisito in the storage.
     *
     * @param App\Http\Requests\RevRequisitosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RevRequisitosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            RevRequisito::create($data);

            return redirect()->route('rev_requisitos.rev_requisito.index')
                             ->with('success_message', trans('rev_requisitos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_requisitos.unexpected_error')]);
        }
    }

    /**
     * Display the specified rev requisito.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $revRequisito = RevRequisito::with('entity','meses','user')->findOrFail($id);

        return view('rev_requisitos.show', compact('revRequisito'));
    }

    /**
     * Show the form for editing the specified rev requisito.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $revRequisito = RevRequisito::findOrFail($id);
        $entities = Entity::pluck('rzon_social','id')->all();
        $mese = Meses::pluck('mes','id')->all();
        $users = User::pluck('name','id')->all();

        return view('rev_requisitos.edit', compact('revRequisito','entities','mese','users','users'));
    }

    /**
     * Update the specified rev requisito in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RevRequisitosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RevRequisitosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $revRequisito = RevRequisito::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $revRequisito->update($data);

            return redirect()->route('rev_requisitos.rev_requisito.index')
                             ->with('success_message', trans('rev_requisitos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_requisitos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified rev requisito from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $revRequisito = RevRequisito::findOrFail($id);
            $revRequisito->delete();

            return redirect()->route('rev_requisitos.rev_requisito.index')
                             ->with('success_message', trans('rev_requisitos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('rev_requisitos.unexpected_error')]);
        }
    }

    

}
