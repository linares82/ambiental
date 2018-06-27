<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EncImpactosFormRequest extends FormRequest
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
            'cliente_id' => 'required',
            'tipo_impacto_id' => 'required',
            //'fecha_inicio' => 'required|date_format:j/n/Y g:i A',
            //'fecha_fin' => 'nullable|date_format:j/n/Y g:i A',
            'notas' => 'required|string|min:1|max:500',
//            'usu_alta_id' => 'required',
//            'usu_mod_id' => 'required',
            'proyecto' => 'required|string|min:1|max:255',
            'up_calle' => 'required|string|min:1|max:255',
            'up_no' => 'required|string|min:1|max:255',
            'up_colonia' => 'required|string|min:1|max:255',
            'up_cp' => 'required|string|min:1|max:255',
            'up_delegacion' => 'required|string|min:1|max:255',
            'up_sup_predio' => 'required|string|min:1|max:255',
            'od_calle' => 'required|string|min:1|max:255',
            'od_no' => 'required|string|min:1|max:255',
            'od_colonia' => 'required|string|min:1|max:255',
            'od_cp' => 'required|string|min:1|max:255',
            'od_delegacion' => 'required|string|min:1|max:255',
            'od_rfc' => 'required|string|min:1|max:255',
            'od_telefono' => 'required|string|min:1|max:255',
            'od_correo' => 'required|string|min:1|max:255',
//            'rl_ape_pat' => 'required|string|min:1|max:255',
//            'rl_ape_mat' => 'required|string|min:1|max:255',
//            'rl_nombre' => 'required|string|min:1|max:255',
//            'rl_id_vigente' => 'required|string|min:1|max:255',
//            'rl_id_no' => 'required|string|min:1|max:255',
//            'rl_no_intrumento' => 'required|string|min:1|max:255',
//            'rl_autorizados' => 'required|string|min:1|max:255',
            'longitud' => 'required|string|min:1|max:255',
            'latitud' => 'required|string|min:1|max:255',
            'altitud' => 'required|string|min:1|max:255',
            'utm_x' => 'required|string|min:1|max:255',
            'utm_y' => 'required|string|min:1|max:255',
//            'entity_id' => 'required',
    
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
        $data = $this->only(['cliente_id','tipo_impacto_id','fecha_inicio','fecha_fin','notas','usu_alta_id','usu_mod_id','proyecto','up_calle','up_no','up_colonia','up_cp','up_delegacion','up_sup_predio','od_calle','od_no','od_colonia','od_cp','od_delegacion','od_rfc','od_telefono','od_correo','rl_ape_pat','rl_ape_mat','rl_nombre','rl_id_vigente','rl_id_no','rl_no_intrumento','rl_autorizados','longitud','latitud','altitud','utm_x','utm_y','entity_id']);



        return $data;
    }

}