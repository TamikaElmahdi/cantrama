<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckContractAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Authentification requise.', 'redirect' => '/register'], 401);
            }
            return redirect()->route('register');
        }

        $user = $request->user();

        if (!$user->canDownload()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Crédits insuffisants.', 'redirect' => '/paiement'], 402);
            }
            return redirect()->route('payment.initiate');
        }

        return $next($request);
    }
}
