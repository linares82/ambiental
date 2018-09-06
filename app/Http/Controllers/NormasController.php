<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Norma;
use App\Http\Controllers\Controller;
use App\Http\Requests\NormasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use DB;

class NormasController extends Controller
{

    /**
     * Display a listing of the normas.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Norma::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$normas = $r->with('user')->paginate(25);
		//$normas = Norma::with('user')->paginate(25);

        return view('normas.index', compact('normas'));
    }

    /**
     * Show the form for creating a new norma.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('normas.create', compact('users','users'));
    }

    /**
     * Store a new norma in the storage.
     *
     * @param App\Http\Requests\NormasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(NormasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Norma::create($data);

            return redirect()->route('normas.norma.index')
                             ->with('success_message', trans('normas.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('normas.unexpected_error')]);
        }
    }

    /**
     * Display the specified norma.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $norma = Norma::with('user')->findOrFail($id);

        return view('normas.show', compact('norma'));
    }

    /**
     * Show the form for editing the specified norma.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $norma = Norma::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('normas.edit', compact('norma','users','users'));
    }

    /**
     * Update the specified norma in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\NormasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, NormasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $norma = Norma::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $norma->update($data);

            return redirect()->route('normas.norma.index')
                             ->with('success_message', trans('normas.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('normas.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified norma from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $norma = Norma::findOrFail($id);
            $norma->delete();

            return redirect()->route('normas.norma.index')
                             ->with('success_message', trans('normas.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('normas.unexpected_error')]);
        }
    }

    

}
