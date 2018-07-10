<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rubro;
use App\Models\Matriz;
use App\Models\Factor;
use App\Models\Especifico;
use App\Models\TipoImpacto;
use App\Http\Controllers\Controller;
use App\Http\Requests\MatrizsFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class MatrizsController extends Controller
{

    /**
     * Display a listing of the matrizs.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
                //dd($input);
		$r=Matriz::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>null){
			$r->where('id', '=', $input['id']);
		}
                if(isset($input['tipo_impacto_id']) and $input['tipo_impacto_id']<>0){
			$r->where('tipo_impacto_id', '=', $input['tipo_impacto_id']);
		}
                if(isset($input['factor_id']) and $input['factor_id']<>0){
			$r->where('factor_id', '=', $input['factor_id']);
		}
		if(isset($input['rubro_id']) and $input['rubro_id']<>0){
			$r->where('rubro_id', '=', $input['rubro_id']);
		}
                if(isset($input['especifico_id']) and $input['especifico_id']<>0){
			$r->where('especifico_id', '=', $input['especifico_id']);
		}
                $tipoImpactos = TipoImpacto::pluck('tipo_impacto','id')->all();
                $factors = Factor::pluck('factor','id')->all();
                $rubros = Rubro::pluck('rubro','id')->all();
                $especificos = Especifico::pluck('especifico','id')->all();
		$matrizs = $r->with('tipoimpacto','factor','rubro','especifico','user')->paginate(25);
		//$matrizs = Matriz::with('tipoimpacto','factor','rubro','especifico','user')->paginate(25);

        return view('matrizs.index', compact('matrizs','tipoImpactos','factors','rubros','especificos'));
    }

    /**
     * Show the form for creating a new matriz.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $tipoImpactos = TipoImpacto::pluck('tipo_impacto','id')->all();
$factors = Factor::pluck('factor','id')->all();
$rubros = Rubro::pluck('rubro','id')->all();
$especificos = Especifico::pluck('especifico','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('matrizs.create', compact('tipoImpactos','factors','rubros','especificos','users','users'));
    }

    /**
     * Store a new matriz in the storage.
     *
     * @param App\Http\Requests\MatrizsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MatrizsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            Matriz::create($data);

            return redirect()->route('matrizs.matriz.index')
                             ->with('success_message', trans('matrizs.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('matrizs.unexpected_error')]);
        }
    }

    /**
     * Display the specified matriz.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $matriz = Matriz::with('tipoimpacto','factor','rubro','especifico','user')->findOrFail($id);

        return view('matrizs.show', compact('matriz'));
    }

    /**
     * Show the form for editing the specified matriz.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $matriz = Matriz::findOrFail($id);
        $tipoImpactos = TipoImpacto::pluck('tipo_impacto','id')->all();
$factors = Factor::pluck('factor','id')->all();
$rubros = Rubro::pluck('rubro','id')->all();
$especificos = Especifico::pluck('especifico','id')->all();
$users = User::pluck('name','id')->all();

        return view('matrizs.edit', compact('matriz','tipoImpactos','factors','rubros','especificos','users','users'));
    }

    /**
     * Update the specified matriz in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\MatrizsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MatrizsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $matriz = Matriz::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $matriz->update($data);

            return redirect()->route('matrizs.matriz.index')
                             ->with('success_message', trans('matrizs.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('matrizs.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified matriz from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $matriz = Matriz::findOrFail($id);
            $matriz->delete();

            return redirect()->route('matrizs.matriz.index')
                             ->with('success_message', trans('matrizs.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('matrizs.unexpected_error')]);
        }
    }



}
