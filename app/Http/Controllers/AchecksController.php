<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ACheck;
use App\Http\Controllers\Controller;
use App\Http\Requests\AChecksFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AChecksController extends Controller
{

    /**
     * Display a listing of the a checks.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=ACheck::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aChecks = $r->with('user')->paginate(25);
		//$aChecks = ACheck::with('user')->paginate(25);

        return view('a_checks.index', compact('aChecks'));
    }

    /**
     * Show the form for creating a new a check.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('a_checks.create', compact('users','users'));
    }

    /**
     * Store a new a check in the storage.
     *
     * @param App\Http\Requests\AChecksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AChecksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            ACheck::create($data);

            return redirect()->route('a_checks.a_check.index')
                             ->with('success_message', trans('a_checks.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_checks.unexpected_error')]);
        }
    }

    /**
     * Display the specified a check.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aCheck = ACheck::with('user')->findOrFail($id);

        return view('a_checks.show', compact('aCheck'));
    }

    /**
     * Show the form for editing the specified a check.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aCheck = ACheck::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('a_checks.edit', compact('aCheck','users','users'));
    }

    /**
     * Update the specified a check in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AChecksFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AChecksFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aCheck = ACheck::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aCheck->update($data);

            return redirect()->route('a_checks.a_check.index')
                             ->with('success_message', trans('a_checks.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_checks.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified a check from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aCheck = ACheck::findOrFail($id);
            $aCheck->delete();

            return redirect()->route('a_checks.a_check.index')
                             ->with('success_message', trans('a_checks.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('a_checks.unexpected_error')]);
        }
    }



}
