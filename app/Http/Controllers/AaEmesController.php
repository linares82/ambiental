<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AaEme;
use App\Http\Controllers\Controller;
use App\Http\Requests\AaEmesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class AaEmesController extends Controller
{

    /**
     * Display a listing of the aa emes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=AaEme::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$aaEmes = $r->with('user')->paginate(25);
		//$aaEmes = AaEme::with('user')->paginate(25);

        return view('aa_emes.index', compact('aaEmes'));
    }

    /**
     * Show the form for creating a new aa eme.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('aa_emes.create', compact('users','users'));
    }

    /**
     * Store a new aa eme in the storage.
     *
     * @param App\Http\Requests\AaEmesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(AaEmesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            AaEme::create($data);

            return redirect()->route('aa_emes.aa_eme.index')
                             ->with('success_message', trans('aa_emes.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_emes.unexpected_error')]);
        }
    }

    /**
     * Display the specified aa eme.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $aaEme = AaEme::with('user')->findOrFail($id);

        return view('aa_emes.show', compact('aaEme'));
    }

    /**
     * Show the form for editing the specified aa eme.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $aaEme = AaEme::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('aa_emes.edit', compact('aaEme','users','users'));
    }

    /**
     * Update the specified aa eme in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\AaEmesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, AaEmesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $aaEme = AaEme::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $aaEme->update($data);

            return redirect()->route('aa_emes.aa_eme.index')
                             ->with('success_message', trans('aa_emes.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_emes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified aa eme from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $aaEme = AaEme::findOrFail($id);
            $aaEme->delete();

            return redirect()->route('aa_emes.aa_eme.index')
                             ->with('success_message', trans('aa_emes.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('aa_emes.unexpected_error')]);
        }
    }



}
