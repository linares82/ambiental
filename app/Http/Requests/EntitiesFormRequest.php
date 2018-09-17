<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class EntitiesFormRequest extends FormRequest
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
            'rzon_social' => 'required|string|min:1|max:255',
            'responsable' => 'required|string|min:1|max:255',
            'dir1' => 'required|string|min:1|max:255',
            'dir2' => 'required|string|min:1|max:255',
            'rfc' => 'required|string|min:1|max:255',
            'abreviatura' => 'required|string|min:1|max:255',
            //'logo' => 'string|min:1|max:255',
            //'usu_alta_id' => 'required',
            //'usu_mod_id' => 'required',
            //'multi_entidad' => 'boolean',
            'entidad_id' => 'nullable',
            //'tema' => 'required|string|min:1|max:255',
    
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
        $data = $this->only(['rzon_social','responsable','dir1','dir2','rfc','abreviatura','logo','usu_alta_id','usu_mod_id','multi_entidad']);

        $data['multi_entidad'] = $this->has('multi_entidad');
        $data['filtred_by_entity'] = $this->has('filtred_by_entity');

        return $data;
    }

}