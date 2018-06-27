<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AreasFormRequest extends FormRequest
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
            'area' => 'required|string|min:1|max:255',
            //'usu_alta_id' => 'required',
            //'usu_mod_id' => 'required',
            //'entity_id' => 'required',
    
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
        $data = $this->only(['area','usu_alta_id','usu_mod_id','entity_id']);



        return $data;
    }

}