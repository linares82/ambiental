<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BitacoraResiduosFormRequest extends FormRequest
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
            'residuo' => 'required',
            'cantidad' => 'required|numeric|min:-999999.99|max:999999.99',
//            'fecha' => 'required|date_format:j/n/Y g:i A',
//            'anio' => 'required|numeric|min:-2147483648|max:2147483647',
//            'mes' => 'required|numeric|min:-2147483648|max:2147483647',
            'lugar_generacion' => 'required|string|min:1|max:255',
            'ubicacion' => 'required|string|min:1|max:255',
            'dispocision' => 'required|string|min:1|max:255',
            'transportista' => 'required|string|min:1|max:255',
            'manifiesto' => 'required|string|min:1|max:255',
            'resp_tecnico' => 'required|string|min:1|max:255',
            'requiere_vobo' => 'required',
            'registro_residuos' => 'required',
            'peligrosidad' => 'required|string|min:1|max:255',
//            'fec_ingreso' => 'required|date_format:j/n/Y g:i A',
            'cedula_operacion' => 'required',
            'factor_indicador' => 'required|numeric|min:-999999.99|max:999999.99',
//            'factor_calculado' => 'required|numeric|min:-999999.99|max:999999.99',
            'responsable_id' => 'required',
//            'entity_id' => 'required',
//            'usu_alta_id' => 'required',
//            'usu_mod_id' => 'required',
//            'fec_salida' => 'nullable|date_format:j/n/Y g:i A',
    
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
        $data = $this->only(['residuo','cantidad','fecha','anio','mes','lugar_generacion','ubicacion','dispocision','transportista','manifiesto','resp_tecnico','requiere_vobo','registro_residuos','peligrosidad','fec_ingreso','cedula_operacion','factor_indicador','factor_calculado','responsable_id','entity_id','usu_alta_id','usu_mod_id','fec_salida']);



        return $data;
    }

}