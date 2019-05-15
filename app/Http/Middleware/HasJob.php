<?php

namespace App\Http\Middleware;

use Closure;

class HasJob
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()->hasJob())
            return redirect('job');
        return $next($request);
    }
}
