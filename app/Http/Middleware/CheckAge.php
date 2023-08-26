<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $age): Response
    {
        // Code Check - Before
        // $age = 18;
        if ($age < 18) {
            abort('403', "AGE $age IS RESTRICTED");
        }
        return $next($request);



        // $response = $next($request);
        // Code Check - After
    }
}
