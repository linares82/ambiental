<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class FilesSProcedimientosFormRequest extends FormRequest
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
            'file_path' => 'required|string|min:1|max:255',
            'descripcion' => 'nullable|string|min:0|max:255',
            's_procedimiento_id' => 'nullable',
    
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
        $data = $this->only(['file_path','descripcion','s_procedimiento_id']);



        return $data;
    }

}