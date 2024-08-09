<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit;

class LogVisits
{
    public function handle(Request $request, Closure $next)
    {
        // Use a session key to track if the visit has been logged
        if (!$request->session()->has('visit_logged')) {
            Visit::create([
                'ip_address' => $request->ip(),
            ]);
            $request->session()->put('visit_logged', true);
        }

        return $next($request);
    }
}

