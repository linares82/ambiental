<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SDocumentosFormRequest extends FormRequest
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
            'documento_id' => 'required',
            'descripcion' => 'required|string|min:1|max:255',
//            'fec_ini_vigencia' => 'required|date_format:j/n/Y g:i A',
//            'fec_fin_vigencia' => 'required|date_format:j/n/Y g:i A',
            'aviso' => 'required',
            'dias_aviso' => 'required|numeric|min:-2147483648|max:2147483647',
            'responsable_id' => 'required',
//            'archivo' => 'required|string|min:1|max:255',
            'observaciones' => 'required|string|min:1|max:255',
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
        $data = $this->only(['documento_id','descripcion','fec_ini_vigencia','fec_fin_vigencia','aviso','dias_aviso','responsable_id','archivo','observaciones','estatus_id','entity_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}