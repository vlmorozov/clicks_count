<?php

namespace Modules\Clicks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClickRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'param1' => 'max:255',
            'param2' => 'max:255',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
