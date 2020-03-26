<?php                                       // php artisan make:middleware  islogin

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class islogin
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
        if(Auth::user()->id){
            return $next($request)->header("Cache-Control", "no-cache, no-store, max-age=0, must-revalidate");
        }
        else{
             return redirect('/login');
        }
    }
}
