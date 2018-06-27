<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EmpleadosFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'ctrl_interno' => 'required|string|min:1|max:255',
            'nombre' => 'required|string|min:1|max:255',
            'direccion' => 'required|string|min:1|max:255',
            'mail' => 'required|string|min:1|max:250',
            'contacto' => 'required|string|min:1|max:255',
            'area_id' => 'required',
            'puesto_id' => 'required',
            'bnd_subordinados' => 'required',
            'jefe_id' => 'required',
            'user_id' => 'required',
            //'entity_id' => 'required',
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
        $data = $this->only(['ctrl_interno','nombre','direccion','mail','contacto','area_id','puesto_id','bnd_subordinados','jefe_id','user_id','entity_id','usu_alta_id','usu_mod_id']);



        return $data;
    }

}