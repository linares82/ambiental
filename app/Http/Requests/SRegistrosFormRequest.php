<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SRegistrosFormRequest extends FormRequest
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
            'grupo_id' => 'required',
            'norma_id' => 'required',
            'elemento_id' => 'required',
            'detalle' => 'required|string|min:1|max:255',
//            'fec_registro' => 'required|date_format:j/n/Y g:i A',
            'aviso' => 'required',
            'dias_aviso' => 'required|numeric|min:-2147483648|max:2147483647',
            'responsable_id' => 'required',
//            'fec_fin_vigencia' => 'required|date_format:j/n/Y g:i A',
            'archivo' => 'required|string|min:1|max:255',
//            'estatus_id' => 'required',
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
        $data = $this->only(['grupo_id','norma_id','elemento_id','detalle','fec_registro','aviso','dias_aviso','responsable_id','fec_fin_vigencia','archivo','estatus_id','entity_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}