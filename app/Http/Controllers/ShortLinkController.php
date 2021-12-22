<?php


namespace App\Http\Controllers;

use App\Http\Requests\GetShortLinkRequest;
use App\Models\ShortLink;
use App\Services\ShortLinkService;
use Illuminate\Support\Facades\Auth;

class ShortLinkController extends Controller
{
    public function showDashboard()
    {
        $shortLinks = ShortLink::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('shortenLink', compact('shortLinks'));
    }

    public function getShortLink(GetShortLinkRequest $request)
    {
        $code = (new ShortLinkService)->shortenLinkCreator($request->customUrl);

        ShortLink::create([
            'code'=>$code,
            'link'=>$request->getShortLinkRequestDTO()->getLink(),
            'secret'=>$request->getShortLinkRequestDTO()->getSecret(),
            'lifetime'=>$request->getShortLinkRequestDTO()->getLifetime(),
            'user_id'=>$request->getShortLinkRequestDTO()->getUserId(),
        ]);

        return redirect('/dashboard')
            ->with('success', 'Shorten link generated');
    }
}
