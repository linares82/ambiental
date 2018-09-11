<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SubequiposFormRequest extends FormRequest
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
            'equipo_id' => 'required',
            'subequipo' => 'required|string|min:1|max:255',
            'clase' => 'required|string|min:1|max:255',
            'marca' => 'required|string|min:1|max:255',
            'modelo' => 'required|string|min:1|max:255',
            'no_serie' => 'required|string|min:1|max:255',
            //'fecha_carga' => 'required|date_format:j/n/Y g:i A',
            'area_id' => 'required',
            'ubicacion' => 'required|string|min:1|max:255',
//            'usu_alta_id' => 'required',
//            'usu_mod_id' => 'required',
//            'entity_id' => 'required',
    
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
        $data = $this->only(['equipo_id','subequipo','clase','marca','modelo','no_serie','fecha_carga','area_id','ubicacion','usu_alta_id','usu_mod_id','entity_id']);



        return $data;
    }

}