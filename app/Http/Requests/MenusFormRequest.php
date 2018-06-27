<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class MenusFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'item' => 'required|string|min:1|max:255',
            'orden' => 'required|numeric|min:-2147483648|max:2147483647',
            'depende_de' => 'required|numeric|min:-2147483648|max:2147483647',
            'link' => 'required|string|min:1|max:255',
            'permiso_id' => 'required',
            'target' => 'required|string|min:1|max:255',
            'usu_alta_id' => 'required',
            'usu_mod_id' => 'required',
            'activo' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'imagen' => 'nullable|numeric|string|min:0|max:200',
    
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
        $data = $this->only(['item','orden','depende_de','link','permiso_id','target','usu_alta_id','usu_mod_id','activo','imagen']);



        return $data;
    }

}