<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ResponseHandler
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $response->setData([
                'data' => $response->getData(),
                'runtime' => microtime(true) - LARAVEL_START,
            ]);
        }

        return $response;
    }
}
