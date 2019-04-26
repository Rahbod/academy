<?php

namespace Appnegar\Cms\Middleware;

use Closure;

class SetDepartment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $department = null)
    {
        setDepartment($request,$department);
        return $next($request);
    }
}
