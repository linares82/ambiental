<?php

namespace App\Http\Controllers;

use App\Models\UsuMod;
use App\Models\MEstatus;
use App\Models\UsuAltum;
use App\Http\Controllers\Controller;
use App\Http\Requests\MEstatusesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class MEstatusesController extends Controller
{

    /**
     * Display a listing of the m estatuses.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=MEstatus::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$mEstatuses = $r->with('usumod','usualtum')->paginate(25);
		//$mEstatuses = MEstatus::with('usumod','usualtum')->paginate(25);

        return view('m_estatuses.index', compact('mEstatuses'));
    }

    /**
     * Show the form for creating a new m estatus.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $usuMods = UsuMod::pluck('id','id')->all();
$usuAlta = UsuAltum::pluck('id','id')->all();
        
        return view('m_estatuses.create', compact('usuMods','usuAlta'));
    }

    /**
     * Store a new m estatus in the storage.
     *
     * @param App\Http\Requests\MEstatusesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MEstatusesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            MEstatus::create($data);

            return redirect()->route('m_estatuses.m_estatus.index')
                             ->with('success_message', trans('m_estatuses.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_estatuses.unexpected_error')]);
        }
    }

    /**
     * Display the specified m estatus.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $mEstatus = MEstatus::with('usumod','usualtum')->findOrFail($id);

        return view('m_estatuses.show', compact('mEstatus'));
    }

    /**
     * Show the form for editing the specified m estatus.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $mEstatus = MEstatus::findOrFail($id);
        $usuMods = UsuMod::pluck('id','id')->all();
$usuAlta = UsuAltum::pluck('id','id')->all();

        return view('m_estatuses.edit', compact('mEstatus','usuMods','usuAlta'));
    }

    /**
     * Update the specified m estatus in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MEstatusesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MEstatusesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $mEstatus = MEstatus::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $mEstatus->update($data);

            return redirect()->route('m_estatuses.m_estatus.index')
                             ->with('success_message', trans('m_estatuses.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_estatuses.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified m estatus from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $mEstatus = MEstatus::findOrFail($id);
            $mEstatus->delete();

            return redirect()->route('m_estatuses.m_estatus.index')
                             ->with('success_message', trans('m_estatuses.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_estatuses.unexpected_error')]);
        }
    }



}
