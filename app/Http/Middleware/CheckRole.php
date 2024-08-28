<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['auth' => 'Silakan login untuk mengakses halaman ini.']);
        }

        $user = Auth::user()->load('role');

        if ($user->role->name == $role) {
            return $next($request);
        }

        return redirect()->route('login')->withErrors(['permission' => 'Akses ditolak. Anda tidak memiliki hak akses yang diperlukan untuk halaman ini.']);

        abort(403, 'Unauthorized');
    }
}
