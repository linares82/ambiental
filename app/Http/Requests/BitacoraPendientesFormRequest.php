<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BitacoraPendientesFormRequest extends FormRequest
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
            'pendiente' => 'required|string|min:1|max:255',
            'comentarios' => 'required|string|min:1|max:255',
//            'observaciones' => 'required|string|min:1|max:255',
            'solucion' => 'required|string|min:1|max:255',
            'fec_planeada' => 'required|date_format:j/n/Y g:i A',
            'fec_fin' => 'required|date_format:j/n/Y g:i A',
            'aviso' => 'required',
            'dias_aviso' => 'required|numeric|min:-2147483648|max:2147483647',
            'responsable_id' => 'required',
//            'bit_st_id' => 'required',
//            'cia_id' => 'required',
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
        $data = $this->only(['pendiente','comentarios','observaciones','solucion','fec_planeada','fec_fin','aviso','dias_aviso','responsable_id','bit_st_id','cia_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}