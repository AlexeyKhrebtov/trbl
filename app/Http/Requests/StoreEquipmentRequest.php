<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentRequest extends FormRequest
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
            'title' => 'required|unique:equipment|max:190',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $equipment = $this->route()->parameter('equipment');

            // ВНИМАТЕЛЬНО!!! - тут исключаем текущий ID из проверки'
            $rules['title'] = 'required|max:190|unique:equipment,title,'. $equipment->id;

            //    Rule::unique('equipment')->ignore($equipment),

        }

        return $rules;
    }
}
