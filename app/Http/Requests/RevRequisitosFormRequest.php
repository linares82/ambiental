<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RevRequisitosFormRequest extends FormRequest
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
//            'cia_id' => 'required',
            'anio' => 'required|numeric|min:-2147483648|max:2147483647',
            'mes_id' => 'required',
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
        $data = $this->only(['cia_id','anio','mes_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}