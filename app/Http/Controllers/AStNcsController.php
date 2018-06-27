<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AStNc;
use App\Http\Controllers\Controller;
use App\Http\Requests\AStNcsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AStNcsController extends Controller
{

    /**
     * Display a listing of the a st ncs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AStNc::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aStNcs = $r->with('user')->paginate(25);
		//$aStNcs = AStNc::with('user')->paginate(25);

        return view('a_st_ncs.index', compact('aStNcs'));
    }

    /**
     * Show the form for creating a new a st nc.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('a_st_ncs.create', compact('users','users'));
    }

    /**
     * Store a new a st nc in the storage.
     *
     * @param App\Http\Requests\AStNcsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AStNcsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AStNc::create($data);

            return redirect()->route('a_st_ncs.a_st_nc.index')
                             ->with('success_message', trans('a_st_ncs.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_st_ncs.unexpected_error')]);
        }
    }

    /**
     * Display the specified a st nc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aStNc = AStNc::with('user')->findOrFail($id);

        return view('a_st_ncs.show', compact('aStNc'));
    }

    /**
     * Show the form for editing the specified a st nc.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aStNc = AStNc::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('a_st_ncs.edit', compact('aStNc','users','users'));
    }

    /**
     * Update the specified a st nc in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AStNcsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AStNcsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aStNc = AStNc::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aStNc->update($data);

            return redirect()->route('a_st_ncs.a_st_nc.index')
                             ->with('success_message', trans('a_st_ncs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_st_ncs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a st nc from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aStNc = AStNc::findOrFail($id);
            $aStNc->delete();

            return redirect()->route('a_st_ncs.a_st_nc.index')
                             ->with('success_message', trans('a_st_ncs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_st_ncs.unexpected_error')]);
        }
    }



}
