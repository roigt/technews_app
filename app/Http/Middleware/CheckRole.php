<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$role): Response
    {
        $user = Auth::user();
        // Si l'utilisateur n'est même pas connecté , on le renvoie au login
        if (!$user) {
            Auth::logout(); //  On supprime la session et le cookie
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('error', "Accès refusé à cette page.");
        }

//        if($user && array_intersect(explode(',',$user->rule->name),$role)){
//            return $next($request);
//        }
        $userRoles=$user->roles->pluck('name')->toArray();
        if ($user && !array_intersect($userRoles,$role)) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('error', "Accès refusé à cette page.");
        }

        return $next($request);
       //abort(403, "Access Denied");
    }
}
