<?php

namespace App\Http\Controllers;

use App\Models\Bnd;
use App\Http\Controllers\Controller;
use App\Http\Requests\BndsFormRequest;
use Exception;
use Illuminate\Http\Request;

class BndsController extends Controller
{

    /**
     * Display a listing of the bnds.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Bnd::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$bnds = $r->paginate(25);
		//$bnds = Bnd::paginate(25);

        return view('bnds.index', compact('bnds'));
    }

    /**
     * Show the form for creating a new bnd.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('bnds.create');
    }

    /**
     * Store a new bnd in the storage.
     *
     * @param App\Http\Requests\BndsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BndsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Bnd::create($data);

            return redirect()->route('bnds.bnd.index')
                             ->with('success_message', trans('bnds.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bnds.unexpected_error')]);
        }
    }

    /**
     * Display the specified bnd.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bnd = Bnd::findOrFail($id);

        return view('bnds.show', compact('bnd'));
    }

    /**
     * Show the form for editing the specified bnd.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bnd = Bnd::findOrFail($id);
        

        return view('bnds.edit', compact('bnd'));
    }

    /**
     * Update the specified bnd in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BndsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BndsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bnd = Bnd::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $bnd->update($data);

            return redirect()->route('bnds.bnd.index')
                             ->with('success_message', trans('bnds.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bnds.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bnd from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bnd = Bnd::findOrFail($id);
            $bnd->delete();

            return redirect()->route('bnds.bnd.index')
                             ->with('success_message', trans('bnds.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bnds.unexpected_error')]);
        }
    }



}
