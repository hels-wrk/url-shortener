<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetShortLinkRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'link' => 'required|url',
            'secret' => 'max:8',
            'customUrl' => 'max:10'
        ];
    }
}
