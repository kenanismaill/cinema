<?php

namespace App\Http\Requests\Api\v1\Film;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFilmRequest extends FormRequest
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
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'required',
            'size' => 'required|integer|max:50|min:2',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'type' => 'required',// maybe create enum for film type then check  if it is included
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:204'
        ];
    }
}
