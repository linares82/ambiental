<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Efecto;
use App\Models\ImpReal;
use App\Models\LnImpacto;
use App\Models\Mitigacion;
use App\Models\Probabilidad;
use App\Models\ImpPotencial;
use App\Models\EmisionEfecto;
use App\Models\Caracteristica;
use App\Models\DuracionAccion;
use App\Models\Reversibilidad;
use App\Models\LnCaracteristica;
use App\Models\ContinuidadEfecto;
use App\Models\IntensidadImpacto;
use App\Http\Controllers\Controller;
use App\Http\Requests\LnCaracteristicasFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class LnCaracteristicasController extends Controller
{

    /**
     * Display a listing of the ln caracteristicas.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=LnCaracteristica::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$lnCaracteristicas = $r->with('lnimpacto','caracteristica','efecto')->paginate(25);
		//$lnCaracteristicas = LnCaracteristica::with('lnimpacto','caracteristica','efecto')->paginate(25);

        return view('ln_caracteristicas.index', compact('lnCaracteristicas'));
    }

    /**
     * Show the form for creating a new ln caracteristica.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $lnImpactos = LnImpacto::pluck('created_at','id')->all();
$caracteristicas = Caracteristica::pluck('caracteristica','id')->all();
$efectos = Efecto::pluck('efecto','id')->all();
$emisionEfectos = EmisionEfecto::pluck('id','id')->all();
$duracionAccions = DuracionAccion::pluck('id','id')->all();
$continuidadEfectos = ContinuidadEfecto::pluck('id','id')->all();
$reversibilidads = Reversibilidad::pluck('id','id')->all();
$probabilidads = Probabilidad::pluck('id','id')->all();
$mitigacions = Mitigacion::pluck('id','id')->all();
$intensidadImpactos = IntensidadImpacto::pluck('id','id')->all();
$impReals = ImpReal::pluck('id','id')->all();
$impPotencials = ImpPotencial::pluck('id','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('ln_caracteristicas.create', compact('lnImpactos','caracteristicas','efectos','emisionEfectos','duracionAccions','continuidadEfectos','reversibilidads','probabilidads','mitigacions','intensidadImpactos','impReals','impPotencials','users','users'));
    }

    /**
     * Store a new ln caracteristica in the storage.
     *
     * @param App\Http\Requests\LnCaracteristicasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(LnCaracteristicasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            LnCaracteristica::create($data);

            return redirect()->route('ln_caracteristicas.ln_caracteristica.index')
                             ->with('success_message', trans('ln_caracteristicas.model_was_added'));

        } catch (Exception $exception) {
            
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ln_caracteristicas.unexpected_error')]);
        }
    }

    /**
     * Display the specified ln caracteristica.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $lnCaracteristica = LnCaracteristica::with('lnimpacto','caracteristica','efecto','emisionefecto','duracionaccion','continuidadefecto','reversibilidad','probabilidad','mitigacion','intensidadimpacto','impreal','imppotencial','user')->findOrFail($id);

        return view('ln_caracteristicas.show', compact('lnCaracteristica'));
    }

    /**
     * Show the form for editing the specified ln caracteristica.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $lnCaracteristica = LnCaracteristica::findOrFail($id);
        $lnImpactos = LnImpacto::pluck('created_at','id')->all();
        $caracteristicas = Caracteristica::pluck('caracteristica','id')->all();
        $efectos = Efecto::pluck('descripcion','id')->all();
        $emisionEfectos = EmisionEfecto::pluck('emision_efecto','id')->all();
        $duracionAccions = DuracionAccion::pluck('duracion_accion','id')->all();
        $continuidadEfectos = ContinuidadEfecto::pluck('continuidad_efecto','id')->all();
        $reversibilidads = Reversibilidad::pluck('reversibilidad','id')->all();
        $probabilidads = Probabilidad::pluck('probabilidad','id')->all();
        $mitigacions = Mitigacion::pluck('mitigacion','id')->all();
        $intensidadImpactos = IntensidadImpacto::pluck('intensidad_impacto','id')->all();
        $impReals = ImpReal::pluck('imp_real','id')->all();
        $impPotencials = ImpPotencial::pluck('imp_potencial','id')->all();
        //dd($lnCaracteristica->toArray());
        return view('ln_caracteristicas.edit', compact('lnCaracteristica','lnImpactos','caracteristicas','efectos','emisionEfectos','duracionAccions','continuidadEfectos','reversibilidads','probabilidads','mitigacions','intensidadImpactos','impReals','impPotencials','users','users'));
    }

    /**
     * Update the specified ln caracteristica in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\LnCaracteristicasFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, LnCaracteristicasFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $lnCaracteristica = LnCaracteristica::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $lnCaracteristica->update($data);

            return redirect()->route('ln_impactos.ln_impacto.edit', $lnCaracteristica->reg_impacto_id)
                             ->with('success_message', trans('ln_caracteristicas.model_was_updated'));

        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ln_caracteristicas.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ln caracteristica from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $lnCaracteristica = LnCaracteristica::findOrFail($id);
            $lnCaracteristica->delete();

            return redirect()->route('ln_caracteristicas.ln_caracteristica.index')
                             ->with('success_message', trans('ln_caracteristicas.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ln_caracteristicas.unexpected_error')]);
        }
    }



}
