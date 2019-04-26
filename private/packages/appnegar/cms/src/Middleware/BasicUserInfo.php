<?php

namespace Appnegar\Cms\Middleware;

use App\Department;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Closure;

class BasicUserInfo
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
        $user = \Auth::user();

        if ($user) {
            setBasicUserSession();
        }

        return $next($request);

    }
}
