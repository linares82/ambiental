<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AStRr;
use App\Http\Controllers\Controller;
use App\Http\Requests\AStRrsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AStRrsController extends Controller
{

    /**
     * Display a listing of the a st rrs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AStRr::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aStRrs = $r->with('user')->paginate(25);
		//$aStRrs = AStRr::with('user')->paginate(25);

        return view('a_st_rrs.index', compact('aStRrs'));
    }

    /**
     * Show the form for creating a new a st rr.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('a_st_rrs.create', compact('users','users'));
    }

    /**
     * Store a new a st rr in the storage.
     *
     * @param App\Http\Requests\AStRrsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AStRrsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AStRr::create($data);

            return redirect()->route('a_st_rrs.a_st_rr.index')
                             ->with('success_message', trans('a_st_rrs.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_st_rrs.unexpected_error')]);
        }
    }

    /**
     * Display the specified a st rr.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aStRr = AStRr::with('user')->findOrFail($id);

        return view('a_st_rrs.show', compact('aStRr'));
    }

    /**
     * Show the form for editing the specified a st rr.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aStRr = AStRr::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('a_st_rrs.edit', compact('aStRr','users','users'));
    }

    /**
     * Update the specified a st rr in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AStRrsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AStRrsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aStRr = AStRr::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aStRr->update($data);

            return redirect()->route('a_st_rrs.a_st_rr.index')
                             ->with('success_message', trans('a_st_rrs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_st_rrs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a st rr from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aStRr = AStRr::findOrFail($id);
            $aStRr->delete();

            return redirect()->route('a_st_rrs.a_st_rr.index')
                             ->with('success_message', trans('a_st_rrs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_st_rrs.unexpected_error')]);
        }
    }



}
