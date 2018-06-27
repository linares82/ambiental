<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RevRequisitosLnsFormRequest extends FormRequest
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
//            'rev_requisitos_id' => 'required',
            'impacto_id' => 'required',
            'condicion_id' => 'required',
            'area_id' => 'required',
            'norma' => 'required|string|min:1|max:255',
            'estatus_id' => 'required',
            'importancia_id' => 'required',
            'responsable_id' => 'required',
            'dias_advertencia1' => 'required|numeric|min:-2147483648|max:2147483647',
            'dias_advertencia2' => 'required|numeric|min:-2147483648|max:2147483647',
            'dias_advertencia3' => 'required|numeric|min:-2147483648|max:2147483647',
            'fec_cumplimiento' => 'required|date_format:j/n/Y g:i A',
//            'observaciones' => 'required|string|min:1|max:255',
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
        $data = $this->only(['rev_requisitos_id','impacto_id','condicion_id','area_id','norma','estatus_id','importancia_id','responsable_id','dias_advertencia1','dias_advertencia2','dias_advertencia3','fec_cumplimiento','observaciones','usu_alta_id','usu_mod_id']);



        return $data;
    }

}