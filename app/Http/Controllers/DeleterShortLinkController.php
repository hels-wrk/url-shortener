<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;

class DeleterShortLinkController extends Controller
{
    public function delete()
    {
        ShortLink::where('code', $_POST['shortLink'])->delete();
        return redirect('/dashboard');
    }
}
