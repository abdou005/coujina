<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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

        $validateRules = [
            'title' => 'required|string|max:255',
            'desc_recipe' => 'required|string|max:255',
            'ingredients' => 'nullable|string|max:255',
            'tags' => 'required',
            'image_recipe' => 'required|image|mimes:jpeg,jpg,png|dimensions:max_width=1500,max_height=1500',
        ];
        if ($this->id){
            $validateRules = [
                'title' => 'required|string|max:255',
                'desc_recipe' => 'required|string|max:255',
                'ingredients' => 'nullable|string|max:255',
                'image_recipe' => 'image|mimes:jpeg,jpg,png|dimensions:max_width=1500,max_height=1500',
            ];
        }
        return $validateRules;
    }
}
