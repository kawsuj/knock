<?php

namespace App\Http\Middleware;

use Closure;
use Knock;
use Auth;

class RedirectIfNotKnockUser
{
    /**
     * Handle an incoming request.
     * Default logic is implemented here to handle requests for Knock services. Implement 
     * your own logic here if you need to. 
     *     
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if (Auth::check()){
	    	if (Knock::isKnockUser()){
	    		return $next($request);
	    	}else{
	    		return redirect('/knock/home');
	    	}
    	}
		return redirect('/login');
        
    }
}
