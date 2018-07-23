<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ARrAmbientalesFormRequest extends FormRequest
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
            'material_id' => 'required',
            'categoria_id' => 'required',
            'documento_id' => 'required',
            'descripcion' => 'required|string|min:1|max:255',
            //'fec_fin_vigencia' => 'required|date_format:j/n/Y g:i A',
//            'archivo' => 'required|string|min:1|max:255',
            'aviso' => 'required',
            'dias_aviso' => 'required|numeric|min:-2147483648|max:2147483647',
            'responsable_id' => 'required',
//            'st_archivo_id' => 'required',
//            'entity_id' => 'required',
//            'usu_alta_id' => 'required',
//            'usu_mod_id' => 'required',
//    
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
        $data = $this->only(['material_id','categoria_id','documento_id','descripcion','fec_fin_vigencia','archivo','aviso','dias_aviso','responsable_id','st_archivo_id','entity_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}