<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsTpoBitacora;
use App\Models\CsTpoInconformidade;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsTpoInconformidadesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsTpoInconformidadesController extends Controller
{

    /**
     * Display a listing of the cs tpo inconformidades.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsTpoInconformidade::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['tpo_bitacora_id']) and $input['tpo_bitacora_id']<>0){
			$r->where('tpo_bitacora_id', '=', $input['tpo_bitacora_id']);
		}
		if(isset($input['tpo_inconformidad']) and $input['tpo_inconformidad']<>""){
			$r->where('tpo_inconformidad', 'like', '%'.$input['tpo_inconformidad'].'%');
		}
                $csTpoBitacoras = CsTpoBitacora::pluck('tpo_bitacora','id')->all();
		$csTpoInconformidades = $r->with('cstpobitacora','user')->paginate(25);
		//$csTpoInconformidades = CsTpoInconformidade::with('cstpobitacora','user')->paginate(25);

        return view('cs_tpo_inconformidades.index', compact('csTpoInconformidades','csTpoBitacoras'));
    }

    /**
     * Show the form for creating a new cs tpo inconformidade.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $csTpoBitacoras = CsTpoBitacora::pluck('tpo_bitacora','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('cs_tpo_inconformidades.create', compact('csTpoBitacoras','users','users'));
    }

    /**
     * Store a new cs tpo inconformidade in the storage.
     *
     * @param App\Http\Requests\CsTpoInconformidadesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsTpoInconformidadesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsTpoInconformidade::create($data);

            return redirect()->route('cs_tpo_inconformidades.cs_tpo_inconformidade.index')
                             ->with('success_message', trans('cs_tpo_inconformidades.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_inconformidades.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs tpo inconformidade.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csTpoInconformidade = CsTpoInconformidade::with('cstpobitacora','user')->findOrFail($id);

        return view('cs_tpo_inconformidades.show', compact('csTpoInconformidade'));
    }

    /**
     * Show the form for editing the specified cs tpo inconformidade.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csTpoInconformidade = CsTpoInconformidade::findOrFail($id);
        $csTpoBitacoras = CsTpoBitacora::pluck('tpo_bitacora','id')->all();
$users = User::pluck('name','id')->all();

        return view('cs_tpo_inconformidades.edit', compact('csTpoInconformidade','csTpoBitacoras','users','users'));
    }

    /**
     * Update the specified cs tpo inconformidade in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsTpoInconformidadesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsTpoInconformidadesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csTpoInconformidade = CsTpoInconformidade::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csTpoInconformidade->update($data);

            return redirect()->route('cs_tpo_inconformidades.cs_tpo_inconformidade.index')
                             ->with('success_message', trans('cs_tpo_inconformidades.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_inconformidades.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs tpo inconformidade from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csTpoInconformidade = CsTpoInconformidade::findOrFail($id);
            $csTpoInconformidade->delete();

            return redirect()->route('cs_tpo_inconformidades.cs_tpo_inconformidade.index')
                             ->with('success_message', trans('cs_tpo_inconformidades.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_inconformidades.unexpected_error')]);
        }
    }



}
