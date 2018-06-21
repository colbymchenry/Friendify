<?php

namespace App\Http\Middleware;

use Closure;

class CheckEmail
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
        \Log::info("TESTING");
        if($request->session()->get('uuid') === null) {
          return redirect('/');
        }
        \Log::info("NOT NULL");
        return $next($request);
    }
}
