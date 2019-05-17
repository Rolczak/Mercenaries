<?php

namespace App\Http\Middleware;

use Closure;

class MainQuests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $quest_id)
    {
        if(auth()->user()->quests->where('id', $quest_id)->first() == null)
           return redirect('home')->with('err','Please complete quests before you explore other functionality');
        return $next($request);
    }
}
