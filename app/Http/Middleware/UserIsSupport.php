<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class UserIsSupport
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
        $user = Auth::User();
        $roles = $user->roles;
        foreach($roles as $role){
            if($role->role == 'support'){
                return $next($request);
            }
        }

        return redirect(route('home'));
       
    }
}
