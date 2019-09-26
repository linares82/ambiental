<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AspectosAmbientalesFormRequest extends FormRequest
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
            'proceso_id' => 'required',
            'area_id' => 'required',
            'actividad' => 'required|string|min:1|max:255',
            'descripcion' => 'required|string|min:1|max:255',
//            'efecto' => 'required|string|min:1|max:255',
            'aspecto_id' => 'required',
            'eme_id' => 'required',
            'condicion_id' => 'required',
            'impacto_id' => 'required',
            'puesto_id' => 'required',
            'al_federal_bnd' => 'required',
            'al_estatal_bnd' => 'required',
            'obj_corporativo_bnd' => 'required',
            'quejas_bnd' => 'required',
            'severidad_id' => 'required',
            'bnd_potencial' => 'required',
            //'frecuencia_id' => 'required',
            'bnd_real' => 'required',
           // 'probabilidad_id' => 'required',
//            'imp_potencial_id' => 'required',
//            'imp_real_id' => 'required',
//            'observaciones' => 'required|string|min:1|max:255',
//            'ctrls_opracionales' => 'required|string|min:1|max:255',
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
        $data = $this->only(['proceso_id','area_id','actividad','descripcion','efecto','aspecto_id','eme_id','condicion_id','impacto_id','puesto_id','al_federal_bnd','al_estatal_bnd','obj_corporativo_bnd','quejas_bnd','severidad_id','bnd_potencial','frecuencia_id','bnd_real','probabilidad_id','imp_potencial_id','imp_real_id','observaciones','ctrls_opracionales','entity_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}