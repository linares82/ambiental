<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BitSt;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitStsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class BitStsController extends Controller
{

    /**
     * Display a listing of the bit sts.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitSt::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$bitSts = $r->with('user')->paginate(25);
		//$bitSts = BitSt::with('user')->paginate(25);

        return view('bit_sts.index', compact('bitSts'));
    }

    /**
     * Show the form for creating a new bit st.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('bit_sts.create', compact('users','users'));
    }

    /**
     * Store a new bit st in the storage.
     *
     * @param App\Http\Requests\BitStsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitStsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            BitSt::create($data);

            return redirect()->route('bit_sts.bit_st.index')
                             ->with('success_message', trans('bit_sts.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bit_sts.unexpected_error')]);
        }
    }

    /**
     * Display the specified bit st.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitSt = BitSt::with('user')->findOrFail($id);

        return view('bit_sts.show', compact('bitSt'));
    }

    /**
     * Show the form for editing the specified bit st.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitSt = BitSt::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('bit_sts.edit', compact('bitSt','users','users'));
    }

    /**
     * Update the specified bit st in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitStsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitStsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitSt = BitSt::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $bitSt->update($data);

            return redirect()->route('bit_sts.bit_st.index')
                             ->with('success_message', trans('bit_sts.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bit_sts.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bit st from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitSt = BitSt::findOrFail($id);
            $bitSt->delete();

            return redirect()->route('bit_sts.bit_st.index')
                             ->with('success_message', trans('bit_sts.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bit_sts.unexpected_error')]);
        }
    }



}
