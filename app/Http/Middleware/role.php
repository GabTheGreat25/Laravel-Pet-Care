<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // $user = Auth::user();
        // if( $user->isAdmin){
        //         return $next($request);
        //     }
        // dd($user->role);
        // dd($roles);
        if(! Auth::user())
            return redirect()->back();
        // dd(Auth::user()->role);
        foreach($roles as $role) {
            if(Auth::user()->role === $role){
                // dump($role);
                return $next($request);
             }
        }
        return redirect()->back(); 
    }
}

