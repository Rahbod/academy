<?php

namespace Appnegar\Cms\Middleware;

use Closure;


class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd('run');
        setLang($request);
        return $next($request);
    }
}
