<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Norma;
use App\Models\Mcheck;
use App\Models\Acheck;
use App\Http\Controllers\Controller;
use App\Http\Requests\MchecksFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class MchecksController extends Controller
{

    /**
     * Display a listing of the mchecks.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
                
		$r=Mcheck::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['a_chequeo']) and $input['a_chequeo']<>0){
			$r->where('a_chequeo', '=', $input['a_chequeo']);
		}
                if(isset($input['norma_id']) and $input['norma_id']<>0){
			$r->where('norma_id', '=', $input['norma_id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
                
		$mchecks = $r->with('acheck','norma')->paginate(25);
		//$mchecks = Mcheck::with('acheck','norma')->paginate(25);
                $achecks = Acheck::pluck('area','id')->all();
                $normas = Norma::pluck('norma','id')->all();
        return view('mchecks.index', compact('mchecks','achecks','normas'));
    }

    /**
     * Show the form for creating a new mcheck.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $achecks = Acheck::pluck('area','id')->all();
$normas = Norma::pluck('norma','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('mchecks.create', compact('achecks','normas','users','users'));
    }

    /**
     * Store a new mcheck in the storage.
     *
     * @param App\Http\Requests\MchecksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MchecksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Mcheck::create($data);

            return redirect()->route('mchecks.mcheck.index')
                             ->with('success_message', trans('mchecks.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('mchecks.unexpected_error')]);
        }
    }

    /**
     * Display the specified mcheck.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $mcheck = Mcheck::with('acheck','norma','user')->findOrFail($id);

        return view('mchecks.show', compact('mcheck'));
    }

    /**
     * Show the form for editing the specified mcheck.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $mcheck = Mcheck::findOrFail($id);
        $achecks = Acheck::pluck('area','id')->all();
$normas = Norma::pluck('norma','id')->all();
$users = User::pluck('name','id')->all();

        return view('mchecks.edit', compact('mcheck','achecks','normas','users','users'));
    }

    /**
     * Update the specified mcheck in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MchecksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MchecksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $mcheck = Mcheck::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $mcheck->update($data);

            return redirect()->route('mchecks.mcheck.index')
                             ->with('success_message', trans('mchecks.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('mchecks.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified mcheck from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $mcheck = Mcheck::findOrFail($id);
            $mcheck->delete();

            return redirect()->route('mchecks.mcheck.index')
                             ->with('success_message', trans('mchecks.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('mchecks.unexpected_error')]);
        }
    }



}
