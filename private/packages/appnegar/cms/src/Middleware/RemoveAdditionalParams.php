<?php

namespace Appnegar\Cms\Middleware;

use Closure;

class RemoveAdditionalParams
{


    public function handle($request, Closure $next)
    {

        $route = $request->route();
        $route->forgetParameter('lang');
        $route->forgetParameter('department');
        return $next($request);
    }
}
