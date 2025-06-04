<?php

// app/Http/Middleware/Admin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // Kalau bukan admin, redirect ke dashboard
        return redirect()->route('dashboard');
    }
}

