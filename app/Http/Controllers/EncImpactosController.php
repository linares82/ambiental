<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entity;
use App\Models\Cliente;
use App\Models\EncImpacto;
use App\Models\LnImpacto;
use App\Models\LnCaracteristica;
use App\Models\TipoImpacto;
use App\Http\Controllers\Controller;
use App\Http\Requests\EncImpactosFormRequest;
use Exception;
use Illuminate\Http\Request;
use Auth;
use Log;
use DB;

class EncImpactosController extends Controller {

    /**
     * Display a listing of the enc impactos.
     *
     * @return Illuminate\View\View
     */
    public function index(Request $request) {
        $input = $request->all();
        $r = EncImpacto::where('id', '<>', '0');
        if (isset($input['id']) and $input['id'] <> null) {
            $r->where('id', '=', $input['id']);
        }
        if (isset($input['cliente_id']) and $input['cliente_id'] <> null) {
            $r->where('cliente_id', '=', $input['cliente_id']);
        }
        if (isset($input['tpo_impacto_id']) and $input['tpo_impacto_id'] <> null) {
            $r->where('tpo_impacto_id', '=', $input['tpo_impacto_id']);
        }
        if (isset($input['fecha_inicio']) and $input['fecha_inicio'] <> null) {
            $r->where('fecha_inicio', '=', date_format(date_create($input['fecha_inicio']),'Y/m/d') );
        }
        if (isset($input['fecha_fin']) and $input['fecha_fin'] <> null) {
            $r->where('fecha_fin', '=', date_format(date_create($input['fecha_fin']),'Y/m/d') );
        }
        if (Auth::user()->canDo('filtro_entity')) {
                    //dd('si puede');
                    $r->where('entity_id', '=', Auth::user()->entity_id);
                }
        $clientes = Cliente::pluck('cliente', 'id')->all();
        $tipoImpactos = TipoImpacto::pluck('tipo_impacto', 'id')->all();
        $encImpactos = $r->with('cliente', 'tipoimpacto')->paginate(25);
        //$encImpactos = EncImpacto::with('cliente','tipoimpacto')->paginate(25);

        return view('enc_impactos.index', compact('encImpactos','tipoImpactos','clientes'));
    }

    /**
     * Show the form for creating a new enc impacto.
     *
     * @return Illuminate\View\View
     */
    public function create() {
        $clientes = Cliente::pluck('cliente', 'id')->all();
        $tipoImpactos = TipoImpacto::pluck('tipo_impacto', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $entities = Entity::pluck('rzon_social', 'id')->all();

        return view('enc_impactos.create', compact('clientes', 'tipoImpactos', 'users', 'users', 'entities'));
    }

    /**
     * Store a new enc impacto in the storage.
     *
     * @param App\Http\Requests\EncImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(EncImpactosFormRequest $request) {
        try {

            $data = $request->getData();

            $data['usu_mod_id'] = Auth::user()->id;
            $data['usu_alta_id'] = Auth::user()->id;
            $data['entity_id'] = Auth::user()->entity_id;
            $enc_impacto = EncImpacto::create($data);
            $lineas = $this->generaLineas($enc_impacto->id);

            return redirect()->route('enc_impactos.enc_impacto.index')
                            ->with('success_message', trans('enc_impactos.model_was_added'));
        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                            ->withErrors(['unexpected_error' => trans('enc_impactos.unexpected_error')]);
        }
    }

    public function generaLineas($enc_impacto) {
        $m_enc_impacto = DB::table('enc_impactos')->where('id', '=', $enc_impacto)->first();
        $m_matriz = Db::table('matrizs as m')
                        ->select('m.id', 'm.factor_id', 'm.rubro_id', 'm.especifico_id')
                        ->where('m.tipo_impacto_id', '=', $m_enc_impacto->tipo_impacto_id)->get();

        foreach ($m_matriz as $combinacion) {
            //log::info(print_r($combinacion));
            $m_linea = array();
            $m_linea['enc_impacto_id'] = $enc_impacto;
            $m_linea['factor_id'] = $combinacion->factor_id;
            $m_linea['rubro_id'] = $combinacion->rubro_id;
            $m_linea['especifico_id'] = $combinacion->especifico_id;
            $m_linea['usu_alta_id'] = Auth::user()->id;
            $m_linea['usu_mod_id'] = Auth::user()->id;
            $m_linea['estatus_id'] = 1;
            $r = LnImpacto::create($m_linea);
            if ($r) {
                $m_caracteristicas = DB::table('caracteristica_matriz as cm')
                        ->select('matriz_id', 'caracteristica_id')
                        ->where('cm.matriz_id', '=', $combinacion->id)
                        ->get();
                foreach ($m_caracteristicas as $caracteristica) {
                    $m_ln_caracteristica = new LnCaracteristica;
                    $m_ln_caracteristica->reg_impacto_id = $r->id;
                    $m_ln_caracteristica->caracteristica_id = $caracteristica->caracteristica_id;
                    $m_ln_caracteristica->efecto_id = 1;
                    $m_ln_caracteristica->desc_efecto = "";
                    $m_ln_caracteristica->descripcion = "";
                    $m_ln_caracteristica->resarcion = "";
                    $m_ln_caracteristica->emision_efecto_id = 1;
                    $m_ln_caracteristica->duracion_accion_id = 1;
                    $m_ln_caracteristica->continuidad_efecto_id = 1;
                    $m_ln_caracteristica->reversibilidad_id = 1;
                    $m_ln_caracteristica->probabilidad_id = 1;
                    $m_ln_caracteristica->mitigacion_id = 1;
                    $m_ln_caracteristica->intensidad_impacto_id = 1;
                    $m_ln_caracteristica->imp_potencial_id = 1;
                    $m_ln_caracteristica->imp_real_id = 1;
                    $m_ln_caracteristica->intensidad_impacto_id = 1;
                    $m_ln_caracteristica->usu_alta_id = Auth::user()->id;
                    $m_ln_caracteristica->usu_mod_id = Auth::user()->id;
                    $m_ln_caracteristica->save();
                }
            }
        }
        return;
    }

    /**
     * Display the specified enc impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id) {
        $encImpacto = EncImpacto::with('cliente', 'tipoimpacto', 'user', 'entity')->findOrFail($id);

        return view('enc_impactos.show', compact('encImpacto'));
    }

    /**
     * Show the form for editing the specified enc impacto.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id) {
        $encImpacto = EncImpacto::findOrFail($id);
        $clientes = Cliente::pluck('cliente', 'id')->all();
        $tipoImpactos = TipoImpacto::pluck('tipo_impacto', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        $entities = Entity::pluck('rzon_social', 'id')->all();

        return view('enc_impactos.edit', compact('encImpacto', 'clientes', 'tipoImpactos', 'users', 'users', 'entities'));
    }

    /**
     * Update the specified enc impacto in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\EncImpactosFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, EncImpactosFormRequest $request) {
        try {

            $data = $request->getData();

            $encImpacto = EncImpacto::findOrFail($id);
            $data['usu_mod_id'] = Auth::user()->id;

            $encImpacto->update($data);

            return redirect()->route('enc_impactos.enc_impacto.index')
                            ->with('success_message', trans('enc_impactos.model_was_updated'));
        } catch (Exception $exception) {
            dd($exception);
            return back()->withInput()
                            ->withErrors(['unexpected_error' => trans('enc_impactos.unexpected_error')]);
        }
    }

    /**
     * Remove the specified enc impacto from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        try {
            $encImpacto = EncImpacto::findOrFail($id);
            $encImpacto->delete();

            return redirect()->route('enc_impactos.enc_impacto.index')
                            ->with('success_message', trans('enc_impactos.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                            ->withErrors(['unexpected_error' => trans('enc_impactos.unexpected_error')]);
        }
    }

}
