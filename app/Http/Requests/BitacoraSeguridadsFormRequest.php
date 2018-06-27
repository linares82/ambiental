<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BitacoraSeguridadsFormRequest extends FormRequest
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
//            'fecha' => 'required|date_format:j/n/Y g:i A',
//            'anio' => 'required|numeric|min:-2147483648|max:2147483647',
//            'mes' => 'required|numeric|min:-2147483648|max:2147483647',
            'tpo_deteccion_id' => 'required',
            'area_id' => 'required',
            'tpo_bitacora_id' => 'required',
            'tpo_inconformidad_id' => 'required',
            'inconformidad' => 'required|string|min:1|max:255',
            'solucion' => 'required|string|min:1|max:255',
            'grupo_id' => 'required',
            'norma_id' => 'required',
            'norma' => 'required|string|min:1|max:255',
            'responsable_id' => 'required',
//            'fec_planeada' => 'required|date_format:j/n/Y g:i A',
//            'fec_solucion' => 'required|date_format:j/n/Y g:i A',
            'costo' => 'required|numeric|min:-999999.99|max:999999.99',
//            'estatus_id' => 'required',
//            'entity_id' => 'required',
//            'usu_alta_id' => 'required',
//            'usu_mod_id' => 'required',
            'dias_aviso' => 'nullable|numeric|min:-2147483648|max:2147483647',
    
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
        $data = $this->only(['fecha','anio','mes','tpo_deteccion_id','area_id','tpo_bitacora_id','tpo_inconformidad_id','inconformidad','solucion','grupo_id','norma_id','norma','responsable_id','fec_planeada','fec_solucion','costo','estatus_id','entity_id','usu_alta_id','usu_mod_id','dias_aviso']);



        return $data;
    }

}