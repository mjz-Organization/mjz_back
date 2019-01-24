<?php

namespace App\Http\Middleware;

use Closure;

class AddUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param string $userType
     * @return mixed
     */
    public function handle($request, Closure $next, $userType = 'student')
    {
        $request->merge(['userType' => $userType]);
        return $next($request);
    }
}
