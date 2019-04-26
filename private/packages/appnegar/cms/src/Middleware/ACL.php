<?php

namespace Appnegar\Cms\Middleware;

use App\Action;
use App\Department;
use Closure;
use Mockery\Exception;

class Acl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $action_id
     * @return mixed
     */
    public function handle($request, Closure $next,$action_id)
    {
                if (session('department')) {
                    $user = session('user_info_' . session('department'));
                    if ($user) {
                        if ($user->canDo($action_id)) {
                            return $next($request);
                        } else {
                            if ($request->expectsJson()) {
                                return response()->json(['error' => 'access denied.'], 401);
                            }
                            return redirect()->route('access_denied', ['lang' => session('lang')]);
                        }
                        return $next($request);
                    } else {
                        //redirect to your login page
                        return redirect('/login');
                    }
                } else {
                    $message = 'دپارتمان مشخص نشده است';
                    throw new Exception($message);
                }


    }
}
