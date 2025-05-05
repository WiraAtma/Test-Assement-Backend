<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class RateLimit
{
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->user()->id;

        $key = "user:$userId:rate_limit";

        $limit = 100; // Batas 100 request
        $window = 3600; // Reset 1 jam kemudian

        $current = Redis::get($key);

        if ($current && $current >= $limit) {
            return response()->json([
                'error' => 'Rate limit exceeded. Please try again later.'
            ], 429);
        }

        Redis::incr($key);

        if ($current === null) {
            Redis::expire($key, $window); 
        }

        return $next($request);
    }    
    
}
