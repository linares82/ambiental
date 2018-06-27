<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CsElementosInspeccionsFormRequest extends FormRequest
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
            'grupo_norma_id' => 'required',
            'norma_id' => 'required',
            'elemento' => 'required|string|min:1|max:255',
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
        $data = $this->only(['grupo_norma_id','norma_id','elemento','usu_alta_id','usu_mod_id']);



        return $data;
    }

}