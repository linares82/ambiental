<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CaTpoBitacora;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaTpoBitacorasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CaTpoBitacorasController extends Controller
{

    /**
     * Display a listing of the ca tpo bitacoras.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CaTpoBitacora::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['tpo_bitacora']) and $input['tpo_bitacora']<>null){
			$r->where('tpo_bitacora', 'like', '%'.$input['tpo_bitacora'].'%');
		}
		$caTpoBitacoras = $r->with('user')->paginate(25);
		//$caTpoBitacoras = CaTpoBitacora::with('user')->paginate(25);

        return view('ca_tpo_bitacoras.index', compact('caTpoBitacoras'));
    }

    /**
     * Show the form for creating a new ca tpo bitacora.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('ca_tpo_bitacoras.create', compact('users','users'));
    }

    /**
     * Store a new ca tpo bitacora in the storage.
     *
     * @param App\Http\Requests\CaTpoBitacorasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CaTpoBitacorasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CaTpoBitacora::create($data);

            return redirect()->route('ca_tpo_bitacoras.ca_tpo_bitacora.index')
                             ->with('success_message', trans('ca_tpo_bitacoras.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_tpo_bitacoras.unexpected_error')]);
        }
    }

    /**
     * Display the specified ca tpo bitacora.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $caTpoBitacora = CaTpoBitacora::with('user')->findOrFail($id);

        return view('ca_tpo_bitacoras.show', compact('caTpoBitacora'));
    }

    /**
     * Show the form for editing the specified ca tpo bitacora.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $caTpoBitacora = CaTpoBitacora::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('ca_tpo_bitacoras.edit', compact('caTpoBitacora','users','users'));
    }

    /**
     * Update the specified ca tpo bitacora in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CaTpoBitacorasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CaTpoBitacorasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $caTpoBitacora = CaTpoBitacora::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $caTpoBitacora->update($data);

            return redirect()->route('ca_tpo_bitacoras.ca_tpo_bitacora.index')
                             ->with('success_message', trans('ca_tpo_bitacoras.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_tpo_bitacoras.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ca tpo bitacora from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $caTpoBitacora = CaTpoBitacora::findOrFail($id);
            $caTpoBitacora->delete();

            return redirect()->route('ca_tpo_bitacoras.ca_tpo_bitacora.index')
                             ->with('success_message', trans('ca_tpo_bitacoras.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ca_tpo_bitacoras.unexpected_error')]);
        }
    }



}
