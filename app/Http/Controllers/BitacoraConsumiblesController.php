<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entity;
use App\Models\CaConsumible;
use App\Models\BitacoraConsumible;
use App\Http\Controllers\Controller;
use App\Http\Requests\BitacoraConsumiblesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class BitacoraConsumiblesController extends Controller
{

    /**
     * Display a listing of the bitacora consumibles.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=BitacoraConsumible::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$bitacoraConsumibles = $r->with('caconsumible','entity','user')->paginate(25);
		//$bitacoraConsumibles = BitacoraConsumible::with('caconsumible','entity','user')->paginate(25);

        return view('bitacora_consumibles.index', compact('bitacoraConsumibles'));
    }

    /**
     * Show the form for creating a new bitacora consumible.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $caConsumibles = CaConsumible::pluck('consumible','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('bitacora_consumibles.create', compact('caConsumibles','entities','users','users'));
    }

    /**
     * Store a new bitacora consumible in the storage.
     *
     * @param App\Http\Requests\BitacoraConsumiblesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(BitacoraConsumiblesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            $data['entity_id']=Auth::user()->entity_id;
            BitacoraConsumible::create($data);

            return redirect()->route('bitacora_consumibles.bitacora_consumible.index')
                             ->with('success_message', trans('bitacora_consumibles.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_consumibles.unexpected_error')]);
        }
    }

    /**
     * Display the specified bitacora consumible.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $bitacoraConsumible = BitacoraConsumible::with('caconsumible','entity','user')->findOrFail($id);

        return view('bitacora_consumibles.show', compact('bitacoraConsumible'));
    }

    /**
     * Show the form for editing the specified bitacora consumible.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $bitacoraConsumible = BitacoraConsumible::findOrFail($id);
        $caConsumibles = CaConsumible::pluck('consumible','id')->all();
$entities = Entity::pluck('rzon_social','id')->all();
$users = User::pluck('name','id')->all();

        return view('bitacora_consumibles.edit', compact('bitacoraConsumible','caConsumibles','entities','users','users'));
    }

    /**
     * Update the specified bitacora consumible in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\BitacoraConsumiblesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, BitacoraConsumiblesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $bitacoraConsumible = BitacoraConsumible::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $bitacoraConsumible->update($data);

            return redirect()->route('bitacora_consumibles.bitacora_consumible.index')
                             ->with('success_message', trans('bitacora_consumibles.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_consumibles.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified bitacora consumible from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $bitacoraConsumible = BitacoraConsumible::findOrFail($id);
            $bitacoraConsumible->delete();

            return redirect()->route('bitacora_consumibles.bitacora_consumible.index')
                             ->with('success_message', trans('bitacora_consumibles.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('bitacora_consumibles.unexpected_error')]);
        }
    }



}
