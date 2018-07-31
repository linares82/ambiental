<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class BitDocEnfermedadesFormRequest extends FormRequest
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
            'bitacora_enfermedade_id' => 'required',
            'documento' => 'required|string|min:1|max:255',
            'archivo' => 'required|string|min:1|max:255',
    
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
        $data = $this->only(['bitacora_enfermedade_id','documento','archivo']);



        return $data;
    }

}