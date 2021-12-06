<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;


class ShortLinkWorkController extends Controller
{
    public function shortenLinkWork($code)
    {
        if (ShortLink::where('code', $code)->where('lifetime', '<', date('Y-m-d'))->first() || ShortLink::where('code', $code)->whereNotNull('secret')->first()) {
            return abort(404);
        }

        $find = ShortLink::where('code', $code)->first();
        return redirect($find->link);
    }

    public function shortenLinkWithSecretKey($code, $secret)
    {
        if (ShortLink::where('code', $code)->where('secret', $secret)->first()) {
            $find = ShortLink::where('code', $code)->first();
            return redirect($find->link);
        }

        return abort(404);
    }
}
