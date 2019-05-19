<?php

namespace Appnegar\Cms\Middleware;

use Closure;


class SetLocale
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
        $lang = 'fa';
//        dd($lang);
        $params = $request->route()->parameters();
        if (isset($params['lang'])) {
            $lang = $params['lang'];
        } else {
            $array = explode('/', $request->route()->uri);
            if (count($array) > 0) {
                $lang = $array[0];
            }
        }

        session(['lang' => $lang]);
        app()->setLocale($lang);

        return $next($request);
    }
}
