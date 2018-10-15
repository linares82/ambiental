<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Http\Request;
use Validator;

use App\Models\Area;
use App\Models\AStNc;
use App\Models\BitacoraResiduo;
use App\Models\BitacoraConsumible;
use App\Models\MMantenimiento;
use App\Models\BitacoraFf;
use App\Models\BitacoraPlanta;
use App\Models\ANoConformidade;
use App\Models\BitacoraAccidente;
use App\Models\BitacoraEnfermedade;
use App\Models\AspectosAmbientale;
use App\Models\Entity;
use App\Models\CaFuentesFija;
use App\Models\CaPlanta;
use App\Models\CaResiduo;
use App\Models\CaConsumible;
use App\Models\CsAccidente;
use App\Models\CsAccione;
use App\Models\CsEnfermedade;
use App\Models\CsTpoDeteccion;
use App\Models\Empleado;
use App\Models\ARrAmbientale;
use Auth;
use PDF;
use DB;

class ConsultasController extends Controller {

	protected $residuos;
	protected $consumibles;
	protected $mantenimientos;
	protected $fuentesFijas;
	protected $plantas;
	protected $no_conformidades;
	protected $accidentes;
	protected $enfermedades;
	protected $aspectos_ambientales;

	public function __construct(BitacoraResiduo $bitacora_res, 
								BitacoraConsumible $bitacora_consu,
								MMantenimiento $m_manto,
								BitacoraFf $bitacora_ff,
								BitacoraPlanta $bitacora_plan,
								ANoConformidade $a_no_confor,
								BitacoraAccidente $bitacora_acci,
								BitacoraEnfermedade $bitacora_enfer,
								AspectosAmbientale $aspectos_amb)
	{
		$this->residuos = $bitacora_res;
		$this->consumibles=$bitacora_consu;
		$this->mantenimientos=$m_manto;
		$this->fuentesFijas=$bitacora_ff;
		$this->plantas=$bitacora_plan;
		$this->no_conformidades=$a_no_confor;
		$this->accidentes=$bitacora_acci;
		$this->enfermedades=$bitacora_enfer;
		$this->aspectos_ambientales=$aspectos_amb;
	}

	public $rulesMessages=array(
			'required' => 'El campo :attribute es obligatorio.',
			'not_in' => 'El campo :attribute es obligatorio.',
		);

	public function getFuenteFija(){
	$cias_ls=Entity::pluck('rzon_social','id');
	$fuentes_fijas_ls=CaFuentesFija::pluck('planta','id');
	$responsables_ls= Empleado::where('entity_id', '=', Auth::user()->entity_id)->pluck('nombre','id');
	return view('consultas.fuentesFijas', compact('cias_ls', 'fuentes_fijas_ls', 'responsables_ls'));	
	}

	public function postFuenteFija(Request $request){
                //dd($request);
		$input = $request->All();
                
		$usuario=Auth::user()->username;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		
                $img  =  Entity::where('id',Auth::user()->entity_id)->value('logo');
                //dd($img);
		
                    /* Reglas de validacion */
                    $rules = array(
			'cia_f' => 'not_in:0',
			'cia_t' => 'not_in:0',
			'fuente_f' => 'not_in:0',
			'fuente_t' => 'not_in:0',
			'responsable_f' => 'required',
			'responsable_t' => 'required',
			'fecha_f' => 'required',
			'fecha_t' => 'required',
		);
		
		$validation = Validator::make($input, $rules, $this->rulesMessages);
		if (!$validation->passes()){
			return Redirect::route('consulta.fuenteFija')
			->withInput()
			->withErrors($validation)
			->with('message', 'Existen errores de validación.');
		}
	
		$fs=$this->fuentesFijas->select('bitacora_ffs.*', 'e.nombre')
						->join('empleados as e', 'e.id', '=', 'bitacora_ffs.responsable_id')
						->whereBetween('bitacora_ffs.entity_id', array($input['cia_f'], $input['cia_t']))
						->whereBetween('bitacora_ffs.ca_fuente_fija_id', array($input['fuente_f'], $input['fuente_t']))
						->whereBetween('bitacora_ffs.responsable_id', array($input['responsable_f'], $input['responsable_t']))
						->whereBetween('bitacora_ffs.fecha', array($input['fecha_f'], date_format(date_create($input['fecha_t']),'Y/m/d')))
						->get();
		//dd($fs);
		$img=asset('storage/entities/'.$img);
		$fecha=date('d/m/Y');
		$pdf = PDF::loadView('consultas.fuentesFijasr', array('fs'=>$fs, 'img'=>$img, 'fecha'=>'fecha'))
		->setPaper('letter','landscape');
		return $pdf->download('reporte.pdf');
		
	}

	public function getPlanta(){
	$cias_ls=Entity::pluck('abreviatura','id');
	$plantas_ls=CaPlanta::pluck('planta','id');
	$responsables_ls=Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id');
	return view('consultas.plantas', compact('cias_ls', 'plantas_ls', 'responsables_ls'));	
	}

	public function postPlanta(Request $request){
		$input = $request->all();
		$usuario=Auth::user()->username;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		$img  =  Entity::where('id',Auth::user()->entity_id)->value('logo');
		
		/* Reglas de validacion */
		$rules = array(
			'cia_f' => 'not_in:0',
			'cia_t' => 'not_in:0',
			'planta_f' => 'not_in:0',
			'planta_t' => 'not_in:0',
			'responsable_f' => 'required',
			'responsable_t' => 'required',
			'fecha_f' => 'required',
			'fecha_t' => 'required',
		);
		
		$validation = Validator::make($input, $rules, $this->rulesMessages);
		if (!$validation->passes()){
			return Redirect::route('consulta.planta')
			->withInput()
			->withErrors($validation)
			->with('message', 'Existen errores de validación.');
		}

		$ps=$this->plantas->whereBetween('entity_id', array($input['cia_f'], $input['cia_t']))
									->whereBetween('planta_id', array($input['planta_f'], $input['planta_t']))
									->whereBetween('responsable_id', array($input['responsable_f'], $input['responsable_t']))
									->whereBetween('fecha', array(date_format(date_create($input['fecha_f']),'Y/m/d'), 
                                                                                                      date_format(date_create($input['fecha_t']),'Y/m/d')))
									->get();
		//dd($ps);
		
		$img=asset('storage/entities/'.$img);
		$fecha=date('d/m/Y');
		$pdf = PDF::loadView('consultas.plantasr', array('ps'=>$ps, 'img'=>$img, 'fecha'=>$fecha))
		->setPaper('letter','landscape');
		return $pdf->download('reporte.pdf');
	}

	public function getResiduo(){
	$cias_ls=Entity::pluck('abreviatura','id');
	$residuos_ls=CaResiduo::pluck('residuo','id');
	$responsables_ls=Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id');
	return view('consultas.residuos', compact('cias_ls', 'residuos_ls', 'responsables_ls'));	
	}

	public function postResiduo(Request $request){
		$input = $request->all();
		$usuario=Auth::user()->username;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		$img  =  Entity::where('id',Auth::user()->entity_id)->value('logo');
		//dd($input['cia_f']);
		/* Reglas de validacion */
		$rules = array(
			'cia_f' => 'not_in:0',
			'cia_t' => 'not_in:0',
			'residuo_f' => 'not_in:0',
			'residuo_t' => 'not_in:0',
			'responsable_f' => 'required',
			'responsable_t' => 'required',
			'fecha_f' => 'required',
			'fecha_t' => 'required',
		);
		
		$validation = Validator::make($input, $rules, $this->rulesMessages);
		
		if (!$validation->passes()){
			return Redirect::route('consulta.residuo')
			->withInput()
			->withErrors($validation)
			->with('message', 'Existen errores de validación.');
		}
		//dd('fil');
		$rs=$this->residuos->whereBetween('entity_id', array($input['cia_f'], $input['cia_t']))
									->whereBetween('residuo', array($input['residuo_f'], $input['residuo_t']))
									->whereBetween('responsable_id', array($input['responsable_f'], $input['responsable_t']))
									->whereBetween('fecha', array(date_format(date_create($input['fecha_f']),'Y/m/d'), 
                                                                                                      date_format(date_create($input['fecha_t']),'Y/m/d')))
									->get();
		//dd($rs);
		
		$img=asset('storage/entities/'.$img);
		$fecha=date('d/m/Y');
		$pdf = PDF::loadView('consultas.residuosr', array('rs'=>$rs, 'img'=>$img, 'fecha'=>$fecha))
		->setPaper('letter','landscape');
		return $pdf->download('reporte.pdf');
	}		

	public function getConsumible(){
	$cias_ls=Entity::pluck('abreviatura','id');
	$consumibles_ls=CaConsumible::pluck('consumible','id');
	$responsables_ls=Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id');
	return view('consultas.consumibles', compact('cias_ls', 'consumibles_ls', 'responsables_ls'));	
	}

	public function postConsumible(Request $request){
		$input = $request->all();
		$usuario=Auth::user()->username;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		$img  =  Entity::where('id',Auth::user()->entity_id)->value('logo');
		
		/* Reglas de validacion */
		$rules = array(
			'cia_f' => 'not_in:0',
			'cia_t' => 'not_in:0',
			'consumible_f' => 'not_in:0',
			'consumible_t' => 'not_in:0',
			'fecha_f' => 'required',
			'fecha_t' => 'required',
		);
		
		$validation = Validator::make($input, $rules, $this->rulesMessages);
		if (!$validation->passes()){
			return Redirect::route('consulta.consumible')
			->withInput()
			->withErrors($validation)
			->with('message', 'Existen errores de validación.');
		}

		
		
		$cs=$this->consumibles->whereBetween('entity_id', array($input['cia_f'], $input['cia_t']))
									->whereBetween('consumible_id', array($input['consumible_f'], $input['consumible_t']))
									->whereBetween('fecha', array(date_format(date_create($input['fecha_f']),'Y/m/d'), 
                                                                                                      date_format(date_create($input['fecha_t']),'Y/m/d')))
									->get();

		
		$img=asset('storage/entities/'.$img);
		$fecha=date('d/m/Y');
		$pdf = PDF::loadView('consultas.consumosr', array('cs'=>$cs, 'img'=>$img, 'fecha'=>$fecha))
		->setPaper('letter','portrait');
		return $pdf->download('reporte.pdf');
	}

	public function getNoConformidades(){
	$cias_ls=Entity::pluck('abreviatura','id');
	$areas_ls=Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id');
	$tpo_detecciones_ls=CsTpoDeteccion::pluck('tpo_deteccion','id');
	$tpo_bitacoras_ls=DB::Table('ca_tpo_bitacoras')->pluck('tpo_bitacora','id');
	$tpo_inconformidades_ls=DB::Table('ca_tpo_no_conformidads')->pluck('tpo_inconformidad','id');
	$responsables_ls=Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id');
	$tpo_detecciones_ls=CsTpoDeteccion::pluck('tpo_deteccion','id');
	$estatus_ls=AStNc::pluck('estatus','id');
	
	return view('consultas.noConformidades', compact('cias_ls',
		'areas_ls', 'tpo_detecciones_ls', 'tpo_bitacoras_ls', 
		'tpo_inconformidades_ls','tpo_detecciones_ls','responsables_ls', 
		'estatus_ls'));	
	}

	public function postNoConformidades(Request $request){
		$input = $request->all();
		$usuario=Auth::user()->username;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		$img  =  Entity::where('id',Auth::user()->entity_id)->value('logo');
		
		/* Reglas de validacion */
		$rules = array(
			'cia_f' => 'not_in:0',
			'cia_t' => 'not_in:0',
			'area_f' => 'not_in:0',
			'area_t' => 'not_in:0',
			'tpo_deteccion_f' => 'not_in:0',
			'tpo_deteccion_t' => 'not_in:0',
			'tpo_bitacora_f' => 'not_in:0',
			'tpo_bitacora_t' => 'not_in:0',
			'tpo_inconformidad_f' => 'not_in:0',
			'tpo_inconformidad_t' => 'not_in:0',
			'responsable_f' => 'required',
			'responsable_t' => 'required',
			'estatus_f' => 'not_in:0',
			'estatus_t' => 'not_in:0',
			'fecha_f' => 'required',
			'fecha_t' => 'required',
		);
		//print_r($input);
		$validation = Validator::make($input, $rules, $this->rulesMessages);
		if (!$validation->passes()){
			return Redirect::route('consulta.noConformidad')
			->withInput()
			->withErrors($validation)
			->with('message', 'Existen errores de validación.');
		}

		
		$ncs=$this->no_conformidades->whereBetween('entity_id', array($input['cia_f'], $input['cia_t']))
									->whereBetween('area_id', array($input['area_f'], $input['area_t']))
									->whereBetween('tpo_deteccion_id', array($input['tpo_deteccion_f'], $input['tpo_deteccion_t']))
									->whereBetween('tpo_bitacora_id', array($input['tpo_bitacora_f'], $input['tpo_bitacora_t']))
									->whereBetween('tpo_inconformidad_id', array($input['tpo_inconformidad_f'], $input['tpo_inconformidad_t']))
									->whereBetween('responsable_id', array($input['responsable_f'], $input['responsable_t']))
									->whereBetween('estatus_id', array($input['estatus_f'], $input['estatus_t']))
									->whereBetween('fecha', array(date_format(date_create($input['fecha_f']),'Y/m/d'), 
                                                                                                      date_format(date_create($input['fecha_t']),'Y/m/d')))
									->get();
		
		
		$img=asset('storage/entities/'.$img);
		$fecha=date('d/m/Y');
		$pdf = PDF::loadView('consultas.noConformidadesr', array('ncs'=>$ncs, 'img'=>$img, 'fecha'=>$fecha))
		->setPaper('letter','portrait');
		return $pdf->download('reporte.pdf');
	}

	public function getAccidentes(){
	
	$cias_ls=Entity::pluck('abreviatura','id');
	$accidentes_ls=CsAccidente::pluck('accidente','id');
	$responsables_ls=Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id');
	$areas_ls=Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id');
	$acciones_ls=CsAccione::pluck('accion','id');
	return view('consultas.accidentes', compact('cias_ls', 'accidentes_ls', 'responsables_ls', 'areas_ls', 'acciones_ls'));	
	}

	public function postAccidentes(Request $request){
		$input = $request->all();
		$usuario=Auth::user()->username;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		$img  =  Entity::where('id',Auth::user()->entity_id)->value('logo');
		
		/* Reglas de validacion */
		$rules = array(
			'cia_f' => 'not_in:0',
			'cia_t' => 'not_in:0',
			'accidente_f' => 'not_in:0',
			'accidente_t' => 'not_in:0',
			'responsable_f' => 'not_in:0',
			'responsable_t' => 'not_in:0',
			'area_f' => 'not_in:0',
			'area_t' => 'not_in:0',
			'accion_f' => 'not_in:0',
			'accion_t' => 'not_in:0',
			'fecha_f' => 'required',
			'fecha_t' => 'required',
		);
		
		$validation = Validator::make($input, $rules, $this->rulesMessages);
		if (!$validation->passes()){
			return Redirect::route('consulta.accidente')
			->withInput()
			->withErrors($validation)
			->with('message', 'Existen errores de validación.');
		}

		
		$as=$this->accidentes->whereBetween('entity_id', array($input['cia_f'], $input['cia_t']))
									->whereBetween('accidente_id', array($input['accidente_f'], $input['accidente_t']))
									->whereBetween('responsable_id', array($input['responsable_f'], $input['responsable_t']))
									->whereBetween('area_id', array($input['area_f'], $input['area_t']))
									->whereBetween('accion_id', array($input['accion_f'], $input['accion_t']))
									->whereBetween('fecha', array(date_format(date_create($input['fecha_f']),'Y/m/d'), 
                                                                                                      date_format(date_create($input['fecha_t']),'Y/m/d')))
									->get();

		
		$img=asset('storage/entities/'.$img);
		$fecha=date('d/m/Y');
		$pdf = PDF::loadView('consultas.accidentesr', array('as'=>$as, 'img'=>$img, 'fecha'=>$fecha))
		->setPaper('letter','portrait');
		return $pdf->download('reporte.pdf');
	}

	public function getEnfermedades(){
	
	$cias_ls=Entity::pluck('abreviatura','id');
	$enfermedades_ls=CsEnfermedade::pluck('enfermedad','id');
	$responsables_ls=Empleado::where('entity_id',Auth::user()->entity_id)->pluck('nombre','id');
	$areas_ls=Area::where('entity_id',Auth::user()->entity_id)->pluck('area','id');
	$acciones_ls=CsAccione::pluck('accion','id');
	return view('consultas.enfermedades', compact('cias_ls', 'enfermedades_ls', 'responsables_ls', 'areas_ls', 'acciones_ls'));	
	}

	public function postEnfermedades(Request $request){
		$input = $request->all();
		$usuario=Auth::user()->username;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		$img  =  Entity::where('id',Auth::user()->entity_id)->value('logo');
		
		/* Reglas de validacion */
		$rules = array(
			'cia_f' => 'not_in:0',
			'cia_t' => 'not_in:0',
			'enfermedad_f' => 'not_in:0',
			'enfermedad_t' => 'not_in:0',
			'area_f' => 'not_in:0',
			'area_t' => 'not_in:0',
			'accion_f' => 'not_in:0',
			'accion_t' => 'not_in:0',
			'fecha_f' => 'required',
			'fecha_t' => 'required',
		);
		
		$validation = Validator::make($input, $rules, $this->rulesMessages);
		if (!$validation->passes()){
			return Redirect::route('consulta.enfermedad')
			->withInput()
			->withErrors($validation)
			->with('message', 'Existen errores de validación.');
		}

		
		$es=$this->enfermedades->whereBetween('entity_id', array($input['cia_f'], $input['cia_t']))
									->whereBetween('enfermedad_id', array($input['enfermedad_f'], $input['enfermedad_t']))
									->whereBetween('area_id', array($input['area_f'], $input['area_t']))
									->whereBetween('accion_id', array($input['accion_f'], $input['accion_t']))
									->whereBetween('fecha', array(date_format(date_create($input['fecha_f']),'Y/m/d'), 
                                                                                                      date_format(date_create($input['fecha_t']),'Y/m/d')))
									->get();

		
		$img=asset('storage/entities/'.$img);
		$fecha=date('d/m/Y');
		$pdf = PDF::loadView('consultas.enfermedadesr', array('es'=>$es, 'img'=>$img, 'fecha'=>$fecha))
		->setPaper('letter','portrait');
		return $pdf->download('reporte.pdf');
	}

	public function getAspectosAmbientales(){
		$procesos_ls=Aa_proceso::pluck('proceso','id');
		$areas_ls=Area::Cia(User::find(Sentry::getUser()->id)->getCia())->pluck('area','id');
		$imp_reals_ls=Imp_real::pluck('imp_real','id');
		$imp_potencials_ls=Imp_potencial::pluck('imp_potencial','id');
		$cias_ls=Entity::pluck('abreviatura','id');
		return view('consultas.aspectosAmbientales', compact('cias_ls', 'imp_potencials_ls', 'imp_reals_ls', 'areas_ls', 'procesos_ls'));	
	}

	public function postAspectosAmbientales(Request $request){
		$input = $request->all();
		$usuario=Auth::user()->username;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		$img  =  Entity::where('id',Auth::user()->entity_id)->value('logo');
		
		/* Reglas de validacion */
		$rules = array(
			'cia_f' => 'not_in:0',
			'cia_t' => 'not_in:0',
			'proceso_f' => 'not_in:0',
			'proceso_t' => 'not_in:0',
			'area_f' => 'not_in:0',
			'area_t' => 'not_in:0',
			'imp_real_f' => 'not_in:0',
			'imp_real_t' => 'not_in:0',
			'imp_potencial_f' => 'required',
			'imp_potencial_t' => 'required',
		);
		
		$validation = Validator::make($input, $rules, $this->rulesMessages);
		if (!$validation->passes()){
			return Redirect::route('consulta.aspectosAmbientales')
			->withInput()
			->withErrors($validation)
			->with('message', 'Existen errores de validación.');
		}

		
		$ass=$this->aspectos_ambientales->whereBetween('entity_id', array($input['cia_f'], $input['cia_t']))
									->whereBetween('proceso_id', array($input['proceso_f'], $input['proceso_t']))
									->whereBetween('area_id', array($input['area_f'], $input['area_t']))
									->whereBetween('imp_real_id', array($input['imp_real_f'], $input['imp_real_t']))
									->whereBetween('imp_potencial_id', array($input['imp_potencial_f'], $input['imp_potencial_t']))
									->get();

		//dd($request->all());
		
		$img=asset('storage/entities/'.$img);
		$fecha=date('d/m/Y');
		$pdf = PDF::loadView('consultas.aspectosAmbientalesr', array('ass'=>$ass, 'img'=>$img, 'fecha'=>$fecha))
		->setPaper('letter','portrait');
		return $pdf->download('reporte.pdf');
	}

	public function getManto(){
		$objetivos_ls=M_objetivo::Cia(User::find(Sentry::getUser()->id)->getCia())->pluck('objetivo','id');
		$estatus_ls=M_estatus::pluck('estatus','id');
		$tpo_mantos_ls=M_tpo_manto::pluck('tpo_manto','id');
		$areas_ls=Area::Cia(User::find(Sentry::getUser()->id)->getCia())->pluck('area','id');
		$cias_ls=Entity::pluck('abreviatura','id');
		return view('consultas.manto', 
				  compact('cias_ls', 'objetivos_ls', 'estatus_ls', 'tpo_mantos_ls',
				  		  'areas_ls'));	
	}

	public function postManto(Request $request){
		$input = $request->all();
		$usuario=Auth::user()->username;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		$img  =  Entity::where('id',Auth::user()->entity_id)->value('logo');
		
		/* Reglas de validacion */
		$rules = array(
			'cia_f' => 'not_in:0',
			'cia_t' => 'not_in:0',
			'area_f' => 'not_in:0',
			'area_t' => 'not_in:0',
			'objetivo_f' => 'not_in:0',
			'objetivo_t' => 'not_in:0',
			'estatus_f' => 'not_in:0',
			'estatus_t' => 'not_in:0',
			'tpo_manto_f' => 'required',
			'tpo_manto_t' => 'required',
		);
		
		$validation = Validator::make($input, $rules, $this->rulesMessages);
		if (!$validation->passes()){
			return Redirect::route('consulta.manto')
			->withInput()
			->withErrors($validation)
			->with('message', 'Existen errores de validación.');
		}

		
		$ms=$this->mantenimientos->whereBetween('m_mantenimientos.entity_id', array($input['cia_f'], $input['cia_t']))
									->join('subequipos as s', 's.id', '=', 'm_mantenimientos.subequipo_id')
									->whereBetween('s.area_id', array($input['area_f'], $input['area_t']))
									->whereBetween('objetivo_id', array($input['objetivo_f'], $input['objetivo_t']))
									->whereBetween('estatus_id', array($input['estatus_f'], $input['estatus_t']))
									->whereBetween('m_tpo_manto_id', array($input['tpo_manto_f'], $input['tpo_manto_t']))
									->get();
		
		//dd($request->all());
		
		$img=asset('storage/entities/'.$img);
		$fecha=date('d/m/Y');
		//dd($img);
		$pdf = PDF::loadView('consultas.mantenimientosr', array('ms'=>$ms, 'img'=>$img, 'fecha'=>$fecha))
		->setPaper('legal','landscape');
		return $pdf->download('reporte.pdf');		
		
		//return view('consultas.mantenimientosr', compact('ms', 'img', 'fecha'));
	}
        
        public function getReqReg(){
	$entities = Entity::pluck('rzon_social','id')->all();
	return view('consultas.req_reg', compact('entities'));	
	}

	public function postReqReg(Request $request){
		$input = $request->all();
                //dd($input);
                $entidad=Entity::find($input['entity_f']);
		$usuario=Auth::user()->username;
		$carpeta=base_path().'/public/reportes/reportes/'.$usuario;
		$img  =  Entity::where('id',Auth::user()->entity_id)->value('logo');
		
		/* Reglas de validacion */
		$rules = array(
			'entity_f' => 'not_in:0',
		);
		
		$validation = Validator::make($input, $rules, $this->rulesMessages);
		if (!$validation->passes()){
			return Redirect::route('consulta.accidente')
			->withInput()
			->withErrors($validation)
			->with('message', 'Existen errores de validación.');
		}

		
		$datos= ARrAmbientale::select('m.material','c.categoria','d.doc','a_rr_ambientales.descripcion','a_rr_ambientales.fec_fin_vigencia',
                                              'e.nombre as responsable','st.estatus','st.avance')
                                     ->join('ca_materials as m','m.id','=','a_rr_ambientales.material_id')
                                     ->join('ca_aa_docs as d', 'd.id','=','a_rr_ambientales.documento_id')
                                     ->join('ca_categorias as c','c.id','=','a_rr_ambientales.categoria_id')
                                     ->join('a_st_rrs as st','st.id','=', 'a_rr_ambientales.st_rr_id')
                                     ->join('empleados as e','e.id','=','a_rr_ambientales.responsable_id')
                                     ->join('a_rr_amb_leyes as l', 'l.descripcion','=','a_rr_ambientales.descripcion')
                                     ->where('a_rr_ambientales.entity_id',$input['entity_f'])
                                     ->where('l.activo','=',1)
                                     ->get();
		
		$img=asset('storage/entities/'.$img);
                $cantidad=count($datos);
                if($cantidad<>0){
                    $fecha=date('d/m/Y');
                    //dd($datos);
                    $pdf = PDF::loadView('consultas.req_regr', array('datos'=>$datos, 
                                                                     'img'=>$img, 
                                                                     'fecha'=>$fecha,
                                                                     'entidad'=>$entidad->rzon_social,
                                                                     'cantidad'=>$cantidad))
                    ->setPaper('letter','portrait');
                    return $pdf->download('reporte.pdf');
                }
		
                return redirect()->route('consultas.consulta.getReqReg')
                             ->with('msj','Sin resultados');
	}
}
