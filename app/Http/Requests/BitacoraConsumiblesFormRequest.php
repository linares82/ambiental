<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BitacoraConsumiblesFormRequest extends FormRequest
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
            'consumible_id' => 'required',
            'consumo' => 'required|numeric|min:-999999.99|max:999999.99',
//            'fecha' => 'required|date_format:j/n/Y g:i A',
//            'anio' => 'required|numeric|min:-2147483648|max:2147483647',
//            'mes' => 'required|numeric|min:-2147483648|max:2147483647',
            'costo' => 'required|numeric|min:-999999.99|max:999999.99',
//            'fec_inicio' => 'required|date_format:j/n/Y g:i A',
//            'fec_fin' => 'required|date_format:j/n/Y g:i A',
            'factor_indicador' => 'required|numeric|min:-999999.99|max:999999.99',
            'factor_calculado' => 'required|numeric|min:-999999.99|max:999999.99',
//            'entity_id' => 'required',
//            'usu_alta_id' => 'required',
//            'usu_mod_id' => 'required',
    
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
        $data = $this->only(['consumible_id','consumo','fecha','anio','mes','costo','fec_inicio','fec_fin','factor_indicador','factor_calculado','entity_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}