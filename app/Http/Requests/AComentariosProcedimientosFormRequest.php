<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AComentariosProcedimientosFormRequest extends FormRequest
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
            'a_procedimiento_id' => 'required',
            'comentario' => 'required|string|min:1|max:255',
            'a_st_procedimiento_id' => 'required',
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
        $data = $this->only(['a_procedimiento_id','comentario','a_st_procedimiento_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}