<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth; 
use App\Models\ActivityLog; 
use Closure;
use Illuminate\Http\Request;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
{
    $response = $next($request);

    // Check if the user is authenticated
    if (Auth::check()) {
        $user = Auth::user();

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => $request->getMethod(),
            'description' => $request->getPathInfo(),
        ]);
    }

    return $response;

}

}
