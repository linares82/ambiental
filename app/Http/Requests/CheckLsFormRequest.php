<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CheckLsFormRequest extends FormRequest
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
            //'check_id' => 'required',
            'a_check_id' => 'required',
            'norma_id' => 'required',
            'no_conformidad' => 'required|string|min:1|max:500',
//            'especifico' => 'required|string|min:1|max:500',
            'requisito' => 'required|string|min:1|max:500',
            'rnc' => 'required|string|min:1|max:255',
            'minimo_vsm' => 'required|numeric|min:-999999.99|max:999999.99',
            'maximo_vsm' => 'required|numeric|min:-999999.99|max:999999.99',
            'cumplimiento' => 'required',
            'monto_min' => 'required|numeric|min:-999999.99|max:999999.99',
            'monto_medio' => 'required|numeric|min:-999999.99|max:999999.99',
            'monto_max' => 'required|numeric|min:-999999.99|max:999999.99',
//            'correccion' => 'required|string|min:1|max:500',
//            'correccion_detallada' => 'required|string|min:1|max:500',
            't_semanas' => 'required|numeric|min:-2147483648|max:2147483647',
//            'responsable' => 'required|string|min:1|max:255',
            'monto_estimado' => 'required|numeric|min:-999999.99|max:999999.99',
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
        $data = $this->only(['check_id','a_check_id','norma_id','no_conformidad','especifico','requisito','rnc','minimo_vsm','maximo_vsm','cumplimiento','monto_min','monto_medio','monto_max','correccion','correccion_detallada','t_semanas','responsable','monto_estimado','usu_alta_id','usu_mod_id']);



        return $data;
    }

}