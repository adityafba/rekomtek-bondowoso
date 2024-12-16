<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginRateLimit
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle(Request $request, Closure $next)
    {
        $key = Str::lower($request->input('email')) . '|' . $request->ip();
        
        if ($this->limiter->tooManyAttempts($key, 5)) { // 5 attempts
            return response()->json([
                'error' => 'Too many login attempts. Please try again later.',
            ], 429);
        }

        $this->limiter->hit($key, 60 * 10); // Decay in 10 minutes

        return $next($request);
    }
}
