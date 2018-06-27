<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CaFuentesFijasFormRequest extends FormRequest
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
            'planta' => 'required|string|min:1|max:255',
            'marca' => 'required|string|min:1|max:255',
            'ubicacion' => 'required|string|min:1|max:255',
            'obs' => 'required|string|min:1|max:255',
            'c_termica' => 'required|string|min:1|max:255',
            'tipo_combustible' => 'required|string|min:1|max:255',
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
        $data = $this->only(['planta','marca','ubicacion','obs','c_termica','tipo_combustible','usu_alta_id','usu_mod_id']);



        return $data;
    }

}