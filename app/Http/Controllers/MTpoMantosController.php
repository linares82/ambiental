<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MTpoManto;
use App\Http\Controllers\Controller;
use App\Http\Requests\MTpoMantosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class MTpoMantosController extends Controller
{

    /**
     * Display a listing of the m tpo mantos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=MTpoManto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$mTpoMantos = $r->with('user')->paginate(25);
		//$mTpoMantos = MTpoManto::with('user')->paginate(25);

        return view('m_tpo_mantos.index', compact('mTpoMantos'));
    }

    /**
     * Show the form for creating a new m tpo manto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('m_tpo_mantos.create', compact('users','users'));
    }

    /**
     * Store a new m tpo manto in the storage.
     *
     * @param App\Http\Requests\MTpoMantosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MTpoMantosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            MTpoManto::create($data);

            return redirect()->route('m_tpo_mantos.m_tpo_manto.index')
                             ->with('success_message', trans('m_tpo_mantos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_tpo_mantos.unexpected_error')]);
        }
    }

    /**
     * Display the specified m tpo manto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $mTpoManto = MTpoManto::with('user')->findOrFail($id);

        return view('m_tpo_mantos.show', compact('mTpoManto'));
    }

    /**
     * Show the form for editing the specified m tpo manto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $mTpoManto = MTpoManto::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('m_tpo_mantos.edit', compact('mTpoManto','users','users'));
    }

    /**
     * Update the specified m tpo manto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MTpoMantosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MTpoMantosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $mTpoManto = MTpoManto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $mTpoManto->update($data);

            return redirect()->route('m_tpo_mantos.m_tpo_manto.index')
                             ->with('success_message', trans('m_tpo_mantos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_tpo_mantos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified m tpo manto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $mTpoManto = MTpoManto::findOrFail($id);
            $mTpoManto->delete();

            return redirect()->route('m_tpo_mantos.m_tpo_manto.index')
                             ->with('success_message', trans('m_tpo_mantos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('m_tpo_mantos.unexpected_error')]);
        }
    }



}
