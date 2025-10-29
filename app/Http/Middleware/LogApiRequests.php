<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        Log::info('API Request', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'body' => $request->all(),
        ]);

        $response = $next($request);

        Log::info('API Response', [
            'status' => $response->status(),
            'content' => $response->getContent(),
        ]);

        return $response;
    }


}
