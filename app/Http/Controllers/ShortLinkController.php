<?php


namespace App\Http\Controllers;

use App\Http\Requests\GetShortLinkRequest;
use App\Models\ShortLink;
use App\Services\ShortLinkService;
use Illuminate\Support\Facades\Auth;
use App\Blacklist;


class ShortLinkController extends Controller
{
    public function showDashboard()
    {
        $shortLinks = ShortLink::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();

        return view('shortenLink', compact('shortLinks'));
    }

    public function getShortLink(GetShortLinkRequest $request)
    {
        $input['link'] = $request->link;
        $input['lifetime'] = $request->linkLifetime;
        $input['secret'] = $request->secret;
        $input['user_id'] = Auth::id();


        if (ShortLink::where('link', $input['link'])->where('user_id', Auth::id())->first()) {
            return redirect('/dashboard')
                ->with('success', 'Shorten link has already been created!');
        }

        if (in_array($request->customUrl, (new Blacklist)->run())) {
            return redirect('/dashboard')
                ->with('success', 'You are using forbidden word for Custom URL!');
        } else {
            $input['code'] = (new ShortLinkService)->shortenLinkCreator($request->customUrl);
        }


        ShortLink::create($input);
        return redirect('/dashboard')
            ->with('success', 'Shorten link generated');
    }
}
