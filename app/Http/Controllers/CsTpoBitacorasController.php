<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CsTpoBitacora;
use App\Http\Controllers\Controller;
use App\Http\Requests\CsTpoBitacorasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class CsTpoBitacorasController extends Controller
{

    /**
     * Display a listing of the cs tpo bitacoras.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=CsTpoBitacora::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
		if(isset($input['tpo_bitacora']) and $input['tpo_bitacora']<>null){
			$r->where('tpo_bitacora', 'like', '%'.$input['tpo_bitacora'].'%');
		}
		$csTpoBitacoras = $r->with('user')->paginate(25);
		//$csTpoBitacoras = CsTpoBitacora::with('user')->paginate(25);

        return view('cs_tpo_bitacoras.index', compact('csTpoBitacoras'));
    }

    /**
     * Show the form for creating a new cs tpo bitacora.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('cs_tpo_bitacoras.create', compact('users','users'));
    }

    /**
     * Store a new cs tpo bitacora in the storage.
     *
     * @param App\Http\Requests\CsTpoBitacorasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(CsTpoBitacorasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            CsTpoBitacora::create($data);

            return redirect()->route('cs_tpo_bitacoras.cs_tpo_bitacora.index')
                             ->with('success_message', trans('cs_tpo_bitacoras.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_bitacoras.unexpected_error')]);
        }
    }

    /**
     * Display the specified cs tpo bitacora.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $csTpoBitacora = CsTpoBitacora::with('user')->findOrFail($id);

        return view('cs_tpo_bitacoras.show', compact('csTpoBitacora'));
    }

    /**
     * Show the form for editing the specified cs tpo bitacora.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $csTpoBitacora = CsTpoBitacora::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('cs_tpo_bitacoras.edit', compact('csTpoBitacora','users','users'));
    }

    /**
     * Update the specified cs tpo bitacora in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\CsTpoBitacorasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, CsTpoBitacorasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $csTpoBitacora = CsTpoBitacora::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $csTpoBitacora->update($data);

            return redirect()->route('cs_tpo_bitacoras.cs_tpo_bitacora.index')
                             ->with('success_message', trans('cs_tpo_bitacoras.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_bitacoras.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cs tpo bitacora from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $csTpoBitacora = CsTpoBitacora::findOrFail($id);
            $csTpoBitacora->delete();

            return redirect()->route('cs_tpo_bitacoras.cs_tpo_bitacora.index')
                             ->with('success_message', trans('cs_tpo_bitacoras.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('cs_tpo_bitacoras.unexpected_error')]);
        }
    }



}
