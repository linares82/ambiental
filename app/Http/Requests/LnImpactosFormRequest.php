<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class LnImpactosFormRequest extends FormRequest
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
//            'enc_impacto_id' => 'required',
            'factor_id' => 'required',
            'rubro_id' => 'required',
            'especifico_id' => 'required',
            'estatus_id' => 'required',
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
        $data = $this->only(['enc_impacto_id','factor_id','rubro_id','especifico_id','estatus_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}