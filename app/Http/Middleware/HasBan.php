<?php

namespace App\Http\Middleware;

use App\Ban;
use Carbon\Carbon;
use Closure;
use function Sodium\compare;

class hasBan
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
        $ban = Ban::all()->where('user_id', $request->user()->id)->where('removed', 0)->where('expired', '>', Carbon::now())->first();
        if( $ban != null)
        {
            return redirect('ban');
        }
        return $next($request);
    }
}
