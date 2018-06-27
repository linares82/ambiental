<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RevDocumentalLnsFormRequest extends FormRequest
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
//            'rev_documental_id' => 'required',
            'tpo_documento_id' => 'required',
            'documento_id' => 'required',
            'grupo_norma_id' => 'required',
            'norma_id' => 'required',
            'estatus_id' => 'required',
            'importancia_id' => 'required',
            'responsable_id' => 'required',
            'dias_advertencia1' => 'required|numeric|min:-2147483648|max:2147483647',
            'dias_advertencia2' => 'required|numeric|min:-2147483648|max:2147483647',
            'dias_advertencia3' => 'required|numeric|min:-2147483648|max:2147483647',
//            'fec_cumplimiento' => 'required|date_format:j/n/Y g:i A',
//            'fec_vencimiento' => 'required|date_format:j/n/Y g:i A',
//            'archivo' => 'required|string|min:1|max:255',
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
        $data = $this->only(['rev_documental_id','tpo_documento_id','documento_id','grupo_norma_id','norma_id','estatus_id','importancia_id','responsable_id','dias_advertencia1','dias_advertencia2','dias_advertencia3','fec_cumplimiento','fec_vencimiento','archivo','observaciones','usu_alta_id','usu_mod_id']);



        return $data;
    }

}