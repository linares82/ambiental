<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class MMantenimientosFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
		return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'no_orden' => 'nullable|string|min:0|max:255',
            'codigo' => 'nullable|string|min:0|max:255',
            'm_tpo_manto_id' => 'required',
            'objetivo_id' => 'required',
            'subequipo_id' => 'required',
            'solicitante_id' => 'required',
            'fec_planeada' => 'required|date_format:j/n/Y g:i A',
            'aviso_bnd' => 'required',
            'dias_aviso' => 'required|numeric|min:-2147483648|max:2147483647',
            'fec_inicio' => 'required|string|min:1',
            'descripcion' => 'required|string|min:1|max:255',
            'lugar' => 'required|string|min:1|max:255',
            'ejecutor_id' => 'required',
            'responsable_id' => 'required',
            'recomendaciones' => 'required|string|min:1|max:255',
            'materiales' => 'required|string|min:1|max:255',
            'horas_inv' => 'required|numeric|min:-999999.99|max:999999.99',
            'costo' => 'required|numeric|min:-999999.99|max:999999.99',
            'tpp_bnd' => 'required',
//            'riesgos' => 'required|string|min:1|max:255',
            'supervision_bnd' => 'required',
            'conoce_procedimiento_bnd' => 'required',
            'lleva_equipo_bnd' => 'required',
            'cumple_puntos_bnd' => 'required',
            'estatus_id' => 'required',
            'eventualidades_bnd' => 'required',
            'levantar_formato_bnd' => 'required',
            'registro_bitacora_bnd' => 'required',
//            'accion' => 'required|string|min:1|max:255',
//            'resultado' => 'required|string|min:1|max:255',
            'fec_final' => 'required|string|min:1',
            'observaciones' => 'required|string|min:1|max:255',
//            'entity_id' => 'required',
//            'usu_alta_id' => 'required',
//            'usu_mod_id' => 'required',
//    
        ];

        return $rules;
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['no_orden','codigo','m_tpo_manto_id','objetivo_id','subequipo_id','solicitante_id','fec_planeada','aviso_bnd','dias_aviso','fec_inicio','descripcion','lugar','ejecutor_id','responsable_id','recomendaciones','materiales','horas_inv','costo','tpp_bnd','riesgos','supervision_bnd','conoce_procedimiento_bnd','lleva_equipo_bnd','cumple_puntos_bnd','estatus_id','eventualidades_bnd','levantar_formato_bnd','registro_bitacora_bnd','accion','resultado','fec_final','observaciones','entity_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}