<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Meses;
use App\Http\Controllers\Controller;
use App\Http\Requests\MesesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class MesesController extends Controller
{

    /**
     * Display a listing of the meses.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Meses::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$mesesObjects = $r->with('user')->paginate(25);
		//$mesesObjects = Meses::with('user')->paginate(25);

        return view('meses.index', compact('mesesObjects'));
    }

    /**
     * Show the form for creating a new meses.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('meses.create', compact('users','users'));
    }

    /**
     * Store a new meses in the storage.
     *
     * @param App\Http\Requests\MesesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MesesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Meses::create($data);

            return redirect()->route('meses.meses.index')
                             ->with('success_message', trans('meses.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('meses.unexpected_error')]);
        }
    }

    /**
     * Display the specified meses.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $meses = Meses::with('user')->findOrFail($id);

        return view('meses.show', compact('meses'));
    }

    /**
     * Show the form for editing the specified meses.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $meses = Meses::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('meses.edit', compact('meses','users','users'));
    }

    /**
     * Update the specified meses in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MesesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MesesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $meses = Meses::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $meses->update($data);

            return redirect()->route('meses.meses.index')
                             ->with('success_message', trans('meses.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('meses.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified meses from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $meses = Meses::findOrFail($id);
            $meses->delete();

            return redirect()->route('meses.meses.index')
                             ->with('success_message', trans('meses.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('meses.unexpected_error')]);
        }
    }



}
