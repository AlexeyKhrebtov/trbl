<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkRequest extends FormRequest
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
            'title' => 'required|unique:work|max:190',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $work = $this->route()->parameter('work');

            // ВНИМАТЕЛЬНО!!! - тут исключаем текущий ID из проверки'
            $rules['title'] = 'required|max:190|unique:work,title,'. $work->id;

            //    Rule::unique('work')->ignore($work),

        }

        return $rules;
    }
}
