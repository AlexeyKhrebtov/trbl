<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetailRequest extends FormRequest
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
            'name' => 'required|max:190',
            'sheet_id' => 'required|integer|numeric|exists:sheets,id',
            'equipment_id' => 'required|integer|numeric|exists:equipment,id',
            'work_id' => 'required|integer|numeric|exists:work,id',
        ];
    }
}
