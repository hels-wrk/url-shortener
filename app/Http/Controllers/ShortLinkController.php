<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ShortLinkController extends Controller
{

    public function index()
    {
        $shortLinks = ShortLink::latest()->get();

        return view('shortenLink', compact('shortLinks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $input['link'] = $request->link;


        foreach (ShortLink::all() as $i) {
            if ($input['link'] == $i['link']) {
                return redirect('/dashboard')
                    ->with('success', 'Shorten link has already been created!');
            }
        }

        if($request->customUrl) {
            $input['code'] = $request->customUrl;
        } else {
            $input['code'] = Str::random(6);
        }

        if($request->linkLifetime) {
            $input['lifetime'] = $request->linkLifetime;
        }

        if($request->secret) {
            $input['secret'] = $request->secret;
        }

        ShortLink::create($input);
        return redirect('/dashboard')
            ->with('success', 'Shorten link generated');

    }

    public function shortenLink($code)
    {
        foreach (ShortLink::all() as $i){
            if($i['code'] == $code && $i['lifetime'] < date('Y-m-d') && $i['lifetime']!= NULL) {
                return redirect('/dashboard')
                    ->with('success', 'Shorten link already died(');
            }elseif($i['code'] == $code && $i['secret']){
                return redirect('/dashboard')
                    ->with('success', 'Something went wrong..');
            }
        }

        $find = ShortLink::where('code', $code)->first();
        return redirect($find->link);
    }
    public function shortenLinkWithSecretKey($code , $secret)
    {

        foreach (ShortLink::all() as $i){
            if($i['code'] == $code && $i['secret'] == $secret && $i['secret']) {
                $find = ShortLink::where('code', $code)->first();
                return redirect($find->link);
            }
        }
        return redirect('/dashboard')
            ->with('success', 'Something went wrong..');

    }
}
