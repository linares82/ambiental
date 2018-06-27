<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rubro;
use App\Models\Factor;
use App\Models\LnImpacto;
use App\Models\EncImpacto;
use App\Models\Especifico;
use App\Models\StRegImpacto;
use App\Models\LnCaracteristica;
use App\Models\Caracteristica;
use App\Models\Efecto;
use App\Models\EmisionEfecto;
use App\Models\DuracionAccion;
use App\Models\ContinuidadEfecto;
use App\Models\Reversibilidad;
use App\Models\Probabilidad;
use App\Models\Mitigacion;
use App\Models\IntensidadImpacto;
use App\Models\ImpReal;
use App\Models\ImpPotencial;
use App\Http\Controllers\Controller;
use App\Http\Requests\LnImpactosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;

class LnImpactosController extends Controller
{

    /**
     * Display a listing of the ln impactos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request)
    {
		$input=$request->all();
		$r=LnImpacto::where('id', '<>', '0');
		if(isset($input['id']) and $input['id']<>0){
			$r->where('id', '=', $input['id']);
		}
		/*if(isset($input['name']) and $input['name']<>""){
			$r->where('name', 'like', '%'.$input['name'].'%');
		}*/
		$lnImpactos = $r->with('encimpacto','factor','rubro','especifico','stregimpacto','user')->paginate(25);
		//$lnImpactos = LnImpacto::with('encimpacto','factor','rubro','especifico','stregimpacto','user')->paginate(25);

        return view('ln_impactos.index', compact('lnImpactos'));
    }

    /**
     * Show the form for creating a new ln impacto.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $encImpactos = EncImpacto::pluck('fecha_inicio','id')->all();
$factors = Factor::pluck('factor','id')->all();
$rubros = Rubro::pluck('rubro','id')->all();
$especificos = Especifico::pluck('especifico','id')->all();
$stRegImpactos = StRegImpacto::pluck('id','id')->all();
$users = User::pluck('name','id')->all();
        
        return view('ln_impactos.create', compact('encImpactos','factors','rubros','especificos','stRegImpactos','users','users'));
    }

    /**
     * Store a new ln impacto in the storage.
     *
     * @param App\Http\Requests\LnImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(LnImpactosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
			$data['usu_mod_id']=Auth::user()->id;
            $data['usu_alta_id']=Auth::user()->id;
            LnImpacto::create($data);

            return redirect()->route('enc_impactos.enc_impacto.index')
                             ->with('success_message', trans('ln_impactos.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ln_impactos.unexpected_error')]);
        }
    }

    /**
     * Display the specified ln impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $lnImpacto = LnImpacto::with('encimpacto','factor','rubro','especifico','stregimpacto','user')->findOrFail($id);

        return view('ln_impactos.show', compact('lnImpacto'));
    }

    /**
     * Show the form for editing the specified ln impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        //LnImpacto
        $lnImpacto = LnImpacto::findOrFail($id);
        $encImpactos = EncImpacto::pluck('fecha_inicio','id')->all();
        $factors = Factor::pluck('factor','id')->all();
        $rubros = Rubro::pluck('rubro','id')->all();
        $especificos = Especifico::pluck('especifico','id')->all();
        $stRegImpactos = StRegImpacto::pluck('st_reg_impacto','id')->all();
        $users = User::pluck('name','id')->all();

        //LnCaracteristicas
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
    //dd($stRegImpactos);
        
        return view('ln_impactos.edit', compact('lnImpacto','encImpactos','factors','rubros','especificos','stRegImpactos','users','users',
                                                'lnCaracteristicas','lnImpactos','caracteristicas','efectos','emisionEfectos','duracionAccions',
                                                'continuidadEfectos','reversibilidads','probabilidads','mitigacions','intensidadImpactos',
                                                'impReals','impPotencials'));
    }

    /**
     * Update the specified ln impacto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\LnImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, LnImpactosFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $lnImpacto = LnImpacto::findOrFail($id);
			$data['usu_mod_id']=Auth::user()->id;
            
            $lnImpacto->update($data);

            return redirect()->route('enc_impactos.enc_impacto.index')
                             ->with('success_message', trans('ln_impactos.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ln_impactos.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified ln impacto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $lnImpacto = LnImpacto::findOrFail($id);
            $lnImpacto->delete();

            return redirect()->route('enc_impactos.enc_impacto.index')
                             ->with('success_message', trans('ln_impactos.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('ln_impactos.unexpected_error')]);
        }
    }

    public function getByEnc(Request $request){
        //dd($request->all());
        $lineas=LnImpacto::select('ln_impactos.id','ln_impactos.enc_impacto_id','f.factor','r.rubro','e.especifico', 'st.st_reg_impacto')
                         ->join('factors as f','f.id', '=', 'ln_impactos.factor_id')
                         ->join('rubros as r','r.id', '=', 'ln_impactos.rubro_id')
                         ->join('especificos as e','e.id', '=', 'ln_impactos.especifico_id')
                         ->join('st_reg_impactos as st','st.id', '=', 'ln_impactos.estatus_id')
                         ->where('enc_impacto_id', '=', $request->get('enc_impacto'))
                         ->get();
        $resultado=array();
        foreach($lineas as $l){
            array_push($resultado, array('factor'=>$l->factor,
                                         'id'=>$l->id,
                                         'enc_impacto_id'=>$l->enc_impacto_id,
                                         'rubro'=>$l->rubro,
                                         'especifico'=>$l->especifico,
                                         'estatus'=>$l->st_reg_impacto));
        }
        echo json_encode($resultado);
        //return ['success'=>true, 'kullanici'=>json_encode($lineas)];
    }

}
