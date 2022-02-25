<?php

namespace App\Http\Requests\Api\v1\Cinema;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCinemaRequest extends FormRequest
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
            'city_id' => ['required', Rule::exists('cities', 'id')],
            'films' => ['required','min:2'],
            'films.*' => ['required', 'distinct', Rule::exists('films', 'id')],
        ];
    }
}
