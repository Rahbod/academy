<?php

namespace Appnegar\Cms\Middleware;

use App\Department;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Closure;

class UserInfo
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
        if(session('department')!=='profile'){
            $user=\Auth::guard(session('department'))->user();
        }
        else{
            $user=\Auth::user();
        }
        if($user){
            setUserSession();
        }
        else{
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }
            if(session('department'))
            {
                return redirect(route('admin.login',['department'=>session('department')]));
            }
            return redirect()->guest(route(session('lang').'/login'));
        }

        return $next($request);

    }
}
