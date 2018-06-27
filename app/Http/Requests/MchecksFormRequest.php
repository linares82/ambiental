<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class MchecksFormRequest extends FormRequest
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
            'a_chequeo' => 'required',
            'norma_id' => 'required',
            'no_conformidad' => 'required|string|min:1|max:500',
            'correccion' => 'required|string|min:1|max:500',
            'requisito' => 'required|string|min:1|max:500',
            'rnc' => 'required|string|min:1|max:255',
            'minimo_vsm' => 'required|numeric|min:-999999.99|max:999999.99',
            'maximo_vsm' => 'required|numeric|min:-999999.99|max:999999.99',
            'orden' => 'required|numeric|min:-2147483648|max:2147483647',
            //'usu_alta_id' => 'required',
            //'usu_mod_id' => 'required',
    
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
        $data = $this->only(['a_chequeo','norma_id','no_conformidad','correccion','requisito','rnc','minimo_vsm','maximo_vsm','orden','usu_alta_id','usu_mod_id']);



        return $data;
    }

}