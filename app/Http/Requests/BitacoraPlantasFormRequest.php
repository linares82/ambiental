<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BitacoraPlantasFormRequest extends FormRequest
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
            'planta_id' => 'required',
            'fecha' => 'required|date_format:j/n/Y g:i A',
//            'anio' => 'required|numeric|min:-2147483648|max:2147483647',
//            'mes' => 'required|numeric|min:-2147483648|max:2147483647',
            'turno_id' => 'required',
            'agua_entrada' => 'required|numeric|min:-999999.99|max:999999.99',
            'agua_salida' => 'required|numeric|min:-999999.99|max:999999.99',
            'q_usados' => 'required|string|min:1|max:255',
            'q_existentes' => 'required|string|min:1|max:255',
            'tiempo_operacion' => 'required|numeric|min:-999999.99|max:999999.99',
            'motivo_paro' => 'required|string|min:1|max:255',
            'vol_lodos' => 'required|numeric|min:-999999.99|max:999999.99',
            'disp_lodos' => 'required|string|min:1|max:255',
            'fec_ult_manto' => 'required|date_format:j/n/Y g:i A',
            'desc_manto' => 'required|string|min:1|max:255',
//            'obs' => 'required|string|min:1|max:255',
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
        $data = $this->only(['planta_id','fecha','anio','mes','turno_id','agua_entrada','agua_salida','q_usados','q_existentes','tiempo_operacion','motivo_paro','vol_lodos','disp_lodos','fec_ult_manto','desc_manto','obs','responsable_id','entity_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}