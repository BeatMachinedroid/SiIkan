<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) { // Auth bawaan untuk user
            return $next($request);
        }

        $user = User::find(Auth::user()->id);
        if ($user) {
            $user->status = 'offline';
            $user->save();
            return redirect('/login')->with('error', 'Anda belum login.');
        }

    }
}
