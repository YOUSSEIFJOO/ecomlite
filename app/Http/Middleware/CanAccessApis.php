<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanAccessApis
{
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->has('secret_api_key')) {

            if($request->secret_api_key === config('Ecomlite.secret_api_key'))
                return $next($request);

            return $this->canNotAccessResponse();
        }

        return $this->canNotAccessResponse();
    }
}
