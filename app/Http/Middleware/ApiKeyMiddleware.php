<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apikey = $request->header('authorization');

        if (!$this->isValidApiKey($apiKey)) {
            return response()->json(['message' => 'Clé API invalide.'], 401);
        } 
        return $next($request);
    }

    private function isValidApiKey($apiKey) 
    {
        if(strpos($apiKey, 'Bearer ') !== false) {
            
            return false;
        }
        
        $apiKey = str_replace('Bearer ', '', $apiKey);
        
        $user = User::where('api_key', $apiKey)->first();

        return $user !== null;
    }
}
