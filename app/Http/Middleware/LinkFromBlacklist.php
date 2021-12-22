<?php

namespace App\Http\Middleware;

use App\Blacklist;
use Closure;
use Illuminate\Http\Request;


class LinkFromBlacklist
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array($request->customUrl, (new Blacklist)->run())) {
            return redirect('/dashboard')
                ->with('success', 'You are using forbidden word for Custom URL!');
        }

        return $next($request);
    }
}
