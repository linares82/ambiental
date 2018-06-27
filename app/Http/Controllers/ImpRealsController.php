<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ImpReal;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImpRealsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ImpRealsController extends Controller
{

    /**
     * Display a listing of the imp reals.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=ImpReal::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$impReals = $r->with('user')->paginate(25);
		//$impReals = ImpReal::with('user')->paginate(25);

        return view('imp_reals.index', compact('impReals'));
    }

    /**
     * Show the form for creating a new imp real.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('imp_reals.create', compact('users','users'));
    }

    /**
     * Store a new imp real in the storage.
     *
     * @param App\Http\Requests\ImpRealsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ImpRealsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            ImpReal::create($data);

            return redirect()->route('imp_reals.imp_real.index')
                             ->with('success_message', trans('imp_reals.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('imp_reals.unexpected_error')]);
        }
    }

    /**
     * Display the specified imp real.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $impReal = ImpReal::with('user')->findOrFail($id);

        return view('imp_reals.show', compact('impReal'));
    }

    /**
     * Show the form for editing the specified imp real.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $impReal = ImpReal::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('imp_reals.edit', compact('impReal','users','users'));
    }

    /**
     * Update the specified imp real in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ImpRealsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ImpRealsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $impReal = ImpReal::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $impReal->update($data);

            return redirect()->route('imp_reals.imp_real.index')
                             ->with('success_message', trans('imp_reals.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('imp_reals.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified imp real from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $impReal = ImpReal::findOrFail($id);
            $impReal->delete();

            return redirect()->route('imp_reals.imp_real.index')
                             ->with('success_message', trans('imp_reals.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('imp_reals.unexpected_error')]);
        }
    }



}
