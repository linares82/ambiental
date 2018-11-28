<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SDocumentosLeyesFormRequest extends FormRequest
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
            //'fec_inicio_vigencia' => 'required|date_format:j/n/Y g:i A',
            //'fec_fin_vigencia' => 'required|date_format:j/n/Y g:i A',
            'aviso' => 'required',
            'dias_aviso' => 'required|numeric|min:-2147483648|max:2147483647',
            'entity_id' => 'required',
            'activo' => 'nullable|string|min:0',
            //'usu_alta_id' => 'required',
            //'usu_mod_id' => 'required',
    
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
        $data = $this->only(['documento_id','descripcion','fec_inicio_vigencia','fec_fin_vigencia','aviso','dias_aviso','entity_id','activo','usu_alta_id','usu_mod_id']);

        $data['activo'] = $this->has('activo');

        return $data;
    }

}