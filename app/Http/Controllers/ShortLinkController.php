<?php

namespace App\Http\Controllers;

use App\Blacklist;
use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ShortLinkController extends Controller
{
    public function index()
    {
        $shortLinks = ShortLink::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();

        return view('shortenLink', compact('shortLinks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url',
            'secret'=>'max:8',
            'customUrl'=>'max:10'
        ]);

        $input['link'] = $request->link;
        $input['lifetime'] = $request->linkLifetime;
        $input['secret'] = $request->secret;


        if(ShortLink::where('link', $input['link'])->where('user_id', Auth::id())->first()) {
            return redirect('/dashboard')
                ->with('success', 'Shorten link has already been created!');
        }

        if(in_array($request->customUrl, (new Blacklist)->run())){
            return redirect('/dashboard')
                ->with('success', 'You are using forbidden word for Custom URL!');
        } elseif(!$request->customUrl) {
            $input['code'] = Str::random(6);
        } else {
            $input['code'] = $request->customUrl;
        }

        $input['user_id'] = Auth::id();

        ShortLink::create($input);
        return redirect('/dashboard')
            ->with('success', 'Shorten link generated');

    }

    public function shortenLink($code)
    {
        if(ShortLink::where('code', $code)->where('lifetime', '<',  date('Y-m-d'))->first() || ShortLink::where('code', $code)->whereNotNull('secret')->first()) {
            return abort(404);
        }

        $find = ShortLink::where('code', $code)->first();
        return redirect($find->link);

    }
    public function shortenLinkWithSecretKey($code , $secret)
    {

        if(ShortLink::where('code', $code)->where('secret', $secret)->first()) {
            $find = ShortLink::where('code', $code)->first();
            return redirect($find->link);
        }

        return abort(404);
    }
}
