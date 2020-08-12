<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSheetRequest extends FormRequest
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
            'number' => 'required|numeric|min:2|max:4294967294',
            'date' => 'required|date',
            'sector_id' => 'required|integer|numeric|exists:sectors,id',
            'status' => 'required|integer|numeric',
        ];
    }
}
