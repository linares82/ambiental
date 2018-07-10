<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MClaseManto;
use App\Http\Controllers\Controller;
use App\Http\Requests\MClaseMantosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class MClaseMantosController extends Controller
{

    /**
     * Display a listing of the m clase mantos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=MClaseManto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['clase_manto']) and $input['clase_manto']<>null){
			$r->where('clase_manto', 'like', '%'.$input['clase_manto'].'%');
		}
		$mClaseMantos = $r->with('user')->paginate(25);
		//$mClaseMantos = MClaseManto::with('user')->paginate(25);

        return view('m_clase_mantos.index', compact('mClaseMantos'));
    }

    /**
     * Show the form for creating a new m clase manto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('m_clase_mantos.create', compact('users','users'));
    }

    /**
     * Store a new m clase manto in the storage.
     *
     * @param App\Http\Requests\MClaseMantosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MClaseMantosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            MClaseManto::create($data);

            return redirect()->route('m_clase_mantos.m_clase_manto.index')
                             ->with('success_message', trans('m_clase_mantos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_clase_mantos.unexpected_error')]);
        }
    }

    /**
     * Display the specified m clase manto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $mClaseManto = MClaseManto::with('user')->findOrFail($id);

        return view('m_clase_mantos.show', compact('mClaseManto'));
    }

    /**
     * Show the form for editing the specified m clase manto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $mClaseManto = MClaseManto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('m_clase_mantos.edit', compact('mClaseManto','users','users'));
    }

    /**
     * Update the specified m clase manto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MClaseMantosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MClaseMantosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $mClaseManto = MClaseManto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $mClaseManto->update($data);

            return redirect()->route('m_clase_mantos.m_clase_manto.index')
                             ->with('success_message', trans('m_clase_mantos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_clase_mantos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified m clase manto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $mClaseManto = MClaseManto::findOrFail($id);
            $mClaseManto->delete();

            return redirect()->route('m_clase_mantos.m_clase_manto.index')
                             ->with('success_message', trans('m_clase_mantos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_clase_mantos.unexpected_error')]);
        }
    }



}
