<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BitacoraAccidentesFormRequest extends FormRequest
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
            'area_id' => 'required',
            'responsable_id' => 'required',
            'persona_id' => 'required',
            'accidente_id' => 'required',
            'descripcion' => 'required|string|min:1|max:255',
            'investigacion' => 'nullable|string|min:0|max:255',
            'procedimiento' => 'required|string|min:1|max:255',
            'accion_id' => 'required',
            'costo_directo' => 'required|numeric|min:-999999.99|max:999999.99',
            'costo_indirecto' => 'required|numeric|min:-999999.99|max:999999.99',
            //'fecha' => 'required|date_format:j/n/Y g:i A',
//            'anio' => 'required|numeric|min:-2147483648|max:2147483647',
//            'mes' => 'required|numeric|min:-2147483648|max:2147483647',
            'turno_id' => 'required',
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
        $data = $this->only(['area_id','responsable_id','persona_id','accidente_id','descripcion','investigacion','procedimiento','accion_id','costo_directo','costo_indirecto','fecha','anio','mes','turno_id','entity_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}