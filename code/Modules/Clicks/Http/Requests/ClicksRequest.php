<?php

namespace Modules\Clicks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClicksRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order.0.column' => 'integer|required',
            'order.0.dir' => 'in:asc,desc',
            'start' => 'integer|min:0',
            'length' => 'integer|min:0',
            'search.value' => 'string|nullable|present',
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
