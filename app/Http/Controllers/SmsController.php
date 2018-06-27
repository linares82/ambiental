<?php

namespace App\Http\Controllers;

use App\Models\Sm;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\SmsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class SmsController extends Controller
{

    /**
     * Display a listing of the sms.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Sm::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$sms = $r->with('user')->paginate(25);
		//$sms = Sm::with('user')->paginate(25);

        return view('sms.index', compact('sms'));
    }

    /**
     * Show the form for creating a new sm.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('sms.create', compact('users'));
    }

    /**
     * Store a new sm in the storage.
     *
     * @param App\Http\Requests\SmsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SmsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            
            Sm::create($data);

            return redirect()->route('sms.sm.index')
                             ->with('success_message', trans('sms.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('sms.unexpected_error')]);
        }
    }

    /**
     * Display the specified sm.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $sm = Sm::with('user')->findOrFail($id);

        return view('sms.show', compact('sm'));
    }

    /**
     * Show the form for editing the specified sm.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $sm = Sm::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('sms.edit', compact('sm','users'));
    }

    /**
     * Update the specified sm in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\SmsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SmsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $sm = Sm::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $sm->update($data);

            return redirect()->route('sms.sm.index')
                             ->with('success_message', trans('sms.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('sms.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified sm from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $sm = Sm::findOrFail($id);
            $sm->delete();

            return redirect()->route('sms.sm.index')
                             ->with('success_message', trans('sms.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('sms.unexpected_error')]);
        }
    }



}
