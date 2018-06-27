<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BitacoraFfsFormRequest extends FormRequest
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
            'ca_fuente_fija_id' => 'required',
            //'fecha' => 'required|date_format:j/n/Y g:i A',
//            'anio' => 'required|numeric|min:-2147483648|max:2147483647',
//            'mes' => 'required|numeric|min:-2147483648|max:2147483647',
            'turno_id' => 'required',
            'consumo' => 'required|numeric|min:-999999.99|max:999999.99',
            'capacidad_diseno' => 'required|numeric|min:-999999.99|max:999999.99',
            'tp_gases' => 'required|numeric|min:-999999.99|max:999999.99',
            'tp_chimenea' => 'required|numeric|min:-999999.99|max:999999.99',
            //'fec_ult_manto' => 'required|date_format:j/n/Y g:i A',
            'desc_manto' => 'required|string|min:1|max:255',
            'obs' => 'required|string|min:1|max:255',
            'responsable_id' => 'required',
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
        $data = $this->only(['ca_fuente_fija_id','fecha','anio','mes','turno_id','consumo','capacidad_diseno','tp_gases','tp_chimenea','fec_ult_manto','desc_manto','obs','responsable_id','entity_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}