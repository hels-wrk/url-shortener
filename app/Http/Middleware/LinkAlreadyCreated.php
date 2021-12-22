<?php

namespace App\Http\Middleware;

use App\Models\ShortLink;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkAlreadyCreated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //model if()
        if (ShortLink::where('link', $request->link)
            ->where('user_id', Auth::id())->first()) {
                return redirect('/dashboard')
                    ->with('success', 'Shorten link has already been created!');
        }
        return $next($request);
    }
}
