<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCabinetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // ToDo: проверка на право на создани
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
            'title' => 'required|unique:cabinets|max:190',
            'location_km' => 'required|integer|numeric',
            'location_piket' => 'nullable|max:190',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'comment' => 'nullable|string',
            'sector_id' => 'required|integer|numeric|exists:sectors,id',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $cabinet = $this->route()->parameter('cabinet');

            // ВНИМАТЕЛЬНО!!! - тут исключаем текущий ID из проверки'
            $rules['title'] = 'required|max:190|unique:cabinets,title,'. $cabinet->id;

            //    Rule::unique('cameras')->ignore($camera),

        }

        return $rules;
    }
}
