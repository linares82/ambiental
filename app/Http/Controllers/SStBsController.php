<?php

namespace App\Http\Controllers;

use App\Models\SStB;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\SStBsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class SStBsController extends Controller
{

    /**
     * Display a listing of the s st bs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=SStB::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$sStBs = $r->with('user')->paginate(25);
		//$sStBs = SStB::with('user')->paginate(25);

        return view('s_st_bs.index', compact('sStBs'));
    }

    /**
     * Show the form for creating a new s st b.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('s_st_bs.create', compact('users','users'));
    }

    /**
     * Store a new s st b in the storage.
     *
     * @param App\Http\Requests\SStBsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SStBsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            SStB::create($data);

            return redirect()->route('s_st_bs.s_st_b.index')
                             ->with('success_message', trans('s_st_bs.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_st_bs.unexpected_error')]);
        }
    }

    /**
     * Display the specified s st b.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $sStB = SStB::with('user')->findOrFail($id);

        return view('s_st_bs.show', compact('sStB'));
    }

    /**
     * Show the form for editing the specified s st b.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sStB = SStB::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('s_st_bs.edit', compact('sStB','users','users'));
    }

    /**
     * Update the specified s st b in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SStBsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SStBsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $sStB = SStB::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $sStB->update($data);

            return redirect()->route('s_st_bs.s_st_b.index')
                             ->with('success_message', trans('s_st_bs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_st_bs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified s st b from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sStB = SStB::findOrFail($id);
            $sStB->delete();

            return redirect()->route('s_st_bs.s_st_b.index')
                             ->with('success_message', trans('s_st_bs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('s_st_bs.unexpected_error')]);
        }
    }



}
