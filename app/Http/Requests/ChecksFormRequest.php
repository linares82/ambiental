<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ChecksFormRequest extends FormRequest
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
            'cliente_id' => 'required',
            'a_check_id' => 'required',
            'solicitud' => 'required|string|min:1|max:255',
            'detalle' => 'required|string|min:1|max:255',
            'fec_apertura' => 'required|date_format:j/n/Y g:i A',
            'fec_cierre' => 'required|date_format:j/n/Y g:i A',
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
        $data = $this->only(['cliente','a_check_id','solicitud','detalle','fec_apertura','fec_cierre','usu_alta_id','usu_mod_id']);



        return $data;
    }

}