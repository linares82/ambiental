<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CondicionesFormRequest extends FormRequest
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
            'impacto_id' => 'required',
            'condicion' => 'required|string|min:1|max:500',
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
        $data = $this->only(['impacto_id','condicion','usu_alta_id','usu_mod_id']);



        return $data;
    }

}