<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class LnCaracteristicasFormRequest extends FormRequest
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
            //'reg_impacto_id' => 'required',
//            'caracteristica_id' => 'required',
            'efecto_id' => 'required',
            //'desc_efecto' => 'required|string|min:1|max:255',
//            'descripcion' => 'required|string|min:1|max:300',
//            'resarcion' => 'required|string|min:1|max:300',
            'emision_efecto_id' => 'required',
            'duracion_accion_id' => 'required',
            'continuidad_efecto_id' => 'required',
            'reversibilidad_id' => 'required',
            'probabilidad_id' => 'required',
            'mitigacion_id' => 'required',
            'intensidad_impacto_id' => 'required',
//            'imp_real_id' => 'required',
//            'imp_potencial_id' => 'required',
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
        $data = $this->only(['reg_impacto_id','caracteristica_id','efecto_id','desc_efecto','descripcion','resarcion','emision_efecto_id','duracion_accion_id','continuidad_efecto_id','reversibilidad_id','probabilidad_id','mitigacion_id','intensidad_impacto_id','imp_real_id','imp_potencial_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}