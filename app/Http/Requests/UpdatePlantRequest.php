<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlantRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->method();
        //if the method is PUT - all fields are required
        if($method == 'PUT'){
            return [
            'name' => ['required'],
            'categories' => ['required', 'exists:categories,id'],
            'climate_id' => ['required', 'exists:climates,id'],
            'origin' => ['required'],
            'description' => ['required']
            ];
        }
        //if other method to update (PATCH) not all methods are required
        else {
            return [
            'name' => ['sometimes', 'required'],
            'categories' => ['sometimes', 'required', 'exists:categories,id'],
            'climate_id' => ['sometimes', 'required', 'exists:climates,id'],
            'origin' => ['sometimes', 'required'],
            'description' => ['sometimes', 'required']
            ];
        }
    }
}
