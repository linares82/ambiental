<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CaResiduosFormRequest extends FormRequest
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
            'residuo' => 'required|string|min:1|max:255',
            'unidad' => 'required|string|min:1|max:255',
            'peligroso' => 'boolean',
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
        $data = $this->only(['residuo','unidad','peligroso','usu_alta_id','usu_mod_id']);

        $data['peligroso'] = $this->has('peligroso');

        return $data;
    }

}