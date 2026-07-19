<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CashierMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (!auth()->check()) {
            return redirect('/login');
        }

        if (
            auth()->user()->role !== 'cashier'
            &&
            auth()->user()->role !== 'admin'
        ) {

            abort(
                403,
                'Akses ditolak. Halaman ini hanya untuk Kasir.'
            );
        }

        return $next($request);
    }
}