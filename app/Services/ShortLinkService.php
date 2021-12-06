<?php

namespace App\Services;

use Illuminate\Support\Str;


class ShortLinkService
{
    public function shortenLinkCreator($shortLink)
    {
        if(!$shortLink) {
            $shortCode = Str::random(6);
        } else {
            $shortCode = $shortLink;
        }

        return $shortCode;
    }
}
