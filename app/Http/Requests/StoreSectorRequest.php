<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectorRequest extends FormRequest
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
        $rules = [
            'title' => 'required|unique:sectors|max:190',
            'comment' => 'nullable|string',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $sector = $this->route()->parameter('sector');

            // ВНИМАТЕЛЬНО!!! - тут исключаем текущий ID из проверки'
            $rules['title'] = 'required|max:190|unique:sectors,title,'. $sector->id;
            //    Rule::unique('sectors')->ignore($camera),
        }

        return $rules;
    }
}
