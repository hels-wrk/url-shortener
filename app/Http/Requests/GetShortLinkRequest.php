<?php

namespace App\Http\Requests;

use App\DTO\GetShortLinkRequestDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GetShortLinkRequest extends FormRequest
{
    public function getShortLinkRequestDTO():GetShortLinkRequestDTO
    {
        return new GetShortLinkRequestDTO(
            Auth::id(),
            $this->link,
            $this->lifetime,
            $this->secret,
        );
    }

    public function rules()
    {
        return [
            'link' => 'required|url',
            'secret' => 'max:8',
            'customUrl' => 'max:10'
        ];
    }
}
