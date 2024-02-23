<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ThrottleRequestsByIp
{
  public function handle(Request $request, Closure $next)
  {
    $ipAddress = $request->ip();
    $key = 'throttle_' . $ipAddress;
    $maxRequests = 3;
    $expirationTimeInSeconds = 1800;

    if (Cache::has($key)) {
      $requestCount = Cache::increment($key);
      if ($requestCount > $maxRequests) {
        return response()->json(['error' => 'Превышено максимальное количество запросов'], 429);
      }
    } else {
      Cache::put($key, 1, $expirationTimeInSeconds);
    }

    return $next($request);
  }
}
