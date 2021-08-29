<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->isActive === 0){
            auth()->logout();
            
            $message = 'Your Account Has been Suspended.';
            return redirect()->route('admin.login')->withMessge($message);
        }

        return $next($request);

        // dd(auth()->user());
    }
}
