<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\BitacoraFf;
use App\Models\BitacoraPlanta;
use App\Models\BitacoraResiduo;
use App\Models\BitacoraConsumible;
use App\Models\ANoConformidade;
use App\Models\BitacoraAccidente;
use App\Models\BitacoraEnfermedade;
use Auth;
use Exception;

class CubosController extends Controller {

	public function getFuenteFija(){
		//DB::table('bitacora_ffs as b')
		$entidad=Auth::user()->entity_id;
		$consulta=BitacoraFf::select('ff.planta as Fuente-Fija','e.nombre as Responsable', 't.turno as Turno',
						'bitacora_ffs.fecha as Fecha', 'bitacora_ffs.anio as Año', 'bitacora_ffs.mes as Mes', 'bitacora_ffs.consumo as Consumo')
					->join('entities as c', 'c.id', '=', 'bitacora_ffs.entity_id')
					->join('ca_fuentes_fijas as ff', 'ff.id', '=', 'bitacora_ffs.ca_fuente_fija_id')
					->join('empleados as e', 'e.id', '=', 'bitacora_ffs.responsable_id')
					->join('turnos as t', 't.id', '=', 'bitacora_ffs.turno_id')
					->where('bitacora_ffs.entity_id', $entidad)
					->get()->toJson();																																																						;
		
	//dd($consulta);
	return view('cubos.fuentesFijas', compact('consulta'));	
	}

	public function getPlanta(){
		$entidad=Auth::user()->entity_id;
		$consulta=BitacoraPlanta::select('p.planta as Planta','e.nombre as Responsable', 't.turno as Turno',
						'bitacora_plantas.fecha as Fecha', 'bitacora_plantas.anio as Año', 'bitacora_plantas.mes as Mes', 
						'bitacora_plantas.agua_entrada as Agua-Entrada', 'bitacora_plantas.agua_salida as Agua-Salida')
					->join('entities as c', 'c.id', '=', 'bitacora_plantas.entity_id')
					->join('ca_plantas as p', 'p.id', '=', 'bitacora_plantas.planta_id')
					->join('empleados as e', 'e.id', '=', 'bitacora_plantas.responsable_id')
					->join('turnos as t', 't.id', '=', 'bitacora_plantas.turno_id')
					->where('bitacora_plantas.entity_id', $entidad)
					->get()->toJson();																																																						;
		
	//dd($consulta);
	return view('cubos.plantas', compact('consulta'));		
	}

	public function getResiduo(){
		$entidad=Auth::user()->entity_id;
		$consulta=BitacoraResiduo::select('r.residuo as Residuo','e.nombre as Responsable', 
						'bitacora_residuos.cantidad as Cantidad', 'bitacora_residuos.fecha as Fecha', 'bitacora_residuos.anio as Año', 
						'bitacora_residuos.mes as Mes', 'bitacora_residuos.lugar_generacion as Lugar-Generación')
					->join('entities as c', 'c.id', '=', 'bitacora_residuos.entity_id')
					->join('ca_residuos as r', 'r.id', '=', 'bitacora_residuos.residuo')
					->join('empleados as e', 'e.id', '=', 'bitacora_residuos.responsable_id')
					->where('bitacora_residuos.entity_id', $entidad)
					->get()->toJson();																																																						;
		
	//dd($consulta);
	return view('cubos.residuos', compact('consulta'));		
	}

	public function getConsumible(){
		$entidad=Auth::user()->entity_id;
		$consulta=BitacoraConsumible::select('co.consumible as Consumible', 
						'bitacora_consumibles.factor_calculado as Factor-Calculado',
						'bitacora_consumibles.consumo as Consumo', 'bitacora_consumibles.fecha as Fecha', 'bitacora_consumibles.anio as Año', 
						'bitacora_consumibles.mes as Mes', 'bitacora_consumibles.costo as Costo')
					->join('entities as c', 'c.id', '=', 'bitacora_consumibles.entity_id')
					->join('ca_consumibles as co', 'co.id', '=', 'bitacora_consumibles.consumible_id')
					->where('bitacora_consumibles.entity_id', $entidad)
					->get()->toJson();																																																						;
		
	//dd($consulta);
	return view('cubos.consumible', compact('consulta'));		
	}	

	public function getNoConformidades(){
		$entidad=Auth::user()->entity_id;
		$consulta=ANoConformidade::select('a_no_conformidades.fecha as Fecha', 
						'a_no_conformidades.anio as Año','a.area as Area', 'td.tpo_deteccion as Tipo-Deteccion',  
						'a_no_conformidades.mes as Mes', 'tb.tpo_bitacora as Tipo-Bitacora', 'e.nombre as Responsable',
						'a_no_conformidades.costo', 'ti.tpo_inconformidad as Tipo-Inconformidad')
					->join('entities as c', 'c.id', '=', 'a_no_conformidades.entity_id')
					->join('ca_tpo_no_conformidads as ti', 'ti.id', '=', 'a_no_conformidades.tpo_inconformidad_id')
					->join('areas as a', 'a.id', '=', 'a_no_conformidades.area_id')
					->join('cs_tpo_deteccions as td', 'td.id', '=', 'a_no_conformidades.tpo_deteccion_id')
					->join('ca_tpo_bitacoras as tb', 'tb.id', '=', 'a_no_conformidades.tpo_bitacora_id')
					->join('empleados as e', 'e.id', '=', 'a_no_conformidades.responsable_id')
					->where('a_no_conformidades.entity_id', $entidad)
					->get()->toJson();																																																						;
		
	//dd($consulta);
	return view('cubos.noConformidades', compact('consulta'));		
	}	

	public function getAccidentes(){
		$entidad=Auth::user()->entity_id;
		$consulta=BitacoraAccidente::select('a.accidente as Accidente', 
						'ar.area as Area', 'e.nombre as Responsable','bitacora_accidentes.fecha as Fecha', 
						'bitacora_accidentes.anio as Año', 'bitacora_accidentes.mes as Mes', 
						'bitacora_accidentes.costo_indirecto as Costo-Indirecto',
						'bitacora_accidentes.costo_directo as Costo-Directo')
					->join('entities as c', 'c.id', '=', 'bitacora_accidentes.entity_id')
					->join('areas as ar', 'ar.id', '=', 'bitacora_accidentes.area_id')
					->join('empleados as e', 'e.id', '=', 'bitacora_accidentes.responsable_id')
					->join('cs_accidentes as a', 'a.id', '=', 'bitacora_accidentes.accidente_id')
					->where('bitacora_accidentes.entity_id', $entidad)
					->get()->toJson();																																																						;
		
	//dd($consulta);
	return view('cubos.accidentes', compact('consulta'));		
	}

	public function getEnfermedades(){
		$entidad=Auth::user()->entity_id;
		$consulta=BitacoraEnfermedade::select('en.enfermedad as Enfermedad', 
						'ar.area as Area', 'bitacora_enfermedades.fecha as Fecha', 
						'bitacora_enfermedades.anio as Año', 'bitacora_enfermedades.mes as Mes', 
						'bitacora_enfermedades.costo_indirecto as Costo-Indirecto',
						'bitacora_enfermedades.costo_directo as Costo-Directo')
					->join('entities as c', 'c.id', '=', 'bitacora_enfermedades.entity_id')
					->join('areas as ar', 'ar.id', '=', 'bitacora_enfermedades.area_id')
					->join('cs_enfermedades as en', 'en.id', '=', 'bitacora_enfermedades.enfermedad_id')
					->where('bitacora_enfermedades.entity_id', $entidad)
					->get()->toJson();																																																						;
		
	//dd($consulta);
	return view('cubos.enfermedades', compact('consulta'));		
	}
  
 
}
