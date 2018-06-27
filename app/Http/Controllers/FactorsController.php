<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Factor;
use App\Http\Controllers\Controller;
use App\Http\Requests\FactorsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class FactorsController extends Controller
{

    /**
     * Display a listing of the factors.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Factor::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$factors = $r->with('user')->paginate(25);
		//$factors = Factor::with('user')->paginate(25);

        return view('factors.index', compact('factors'));
    }

    /**
     * Show the form for creating a new factor.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('factors.create', compact('users','users'));
    }

    /**
     * Store a new factor in the storage.
     *
     * @param App\Http\Requests\FactorsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(FactorsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Factor::create($data);

            return redirect()->route('factors.factor.index')
                             ->with('success_message', trans('factors.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('factors.unexpected_error')]);
        }
    }

    /**
     * Display the specified factor.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $factor = Factor::with('user')->findOrFail($id);

        return view('factors.show', compact('factor'));
    }

    /**
     * Show the form for editing the specified factor.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $factor = Factor::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('factors.edit', compact('factor','users','users'));
    }

    /**
     * Update the specified factor in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\FactorsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, FactorsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $factor = Factor::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $factor->update($data);

            return redirect()->route('factors.factor.index')
                             ->with('success_message', trans('factors.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('factors.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified factor from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $factor = Factor::findOrFail($id);
            $factor->delete();

            return redirect()->route('factors.factor.index')
                             ->with('success_message', trans('factors.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('factors.unexpected_error')]);
        }
    }



}
