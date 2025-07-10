<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       //parametro para inserccion en la base de datosxdd
       return [
        'numInventario' =>'required|max:60|unique:inventarios',
        'numSerie' =>'required|max:60|unique:inventarios'
     ];
    }
}
