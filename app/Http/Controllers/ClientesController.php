<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientesFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class ClientesController extends Controller
{

    /**
     * Display a listing of the clientes.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=Cliente::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$clientes = $r->with('user')->paginate(25);
		//$clientes = Cliente::with('user')->paginate(25);

        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new cliente.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        
        return view('clientes.create', compact('users','users'));
    }

    /**
     * Store a new cliente in the storage.
     *
     * @param App\Http\Requests\ClientesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ClientesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Cliente::create($data);

            return redirect()->route('clientes.cliente.index')
                             ->with('success_message', trans('clientes.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('clientes.unexpected_error')]);
        }
    }

    /**
     * Display the specified cliente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $cliente = Cliente::with('user')->findOrFail($id);

        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified cliente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        $users = User::pluck('name','id')->all();

        return view('clientes.edit', compact('cliente','users','users'));
    }

    /**
     * Update the specified cliente in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\ClientesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ClientesFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $cliente = Cliente::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $cliente->update($data);

            return redirect()->route('clientes.cliente.index')
                             ->with('success_message', trans('clientes.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('clientes.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified cliente from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            return redirect()->route('clientes.cliente.index')
                             ->with('success_message', trans('clientes.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('clientes.unexpected_error')]);
        }
    }



}
