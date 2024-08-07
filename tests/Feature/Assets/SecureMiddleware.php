<?php

namespace Tests\Feature\Assets;

use Closure;

use Illuminate\Http\Request;

class SecureMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('required') !== 'secret') {
            abort(403);
        }

        return $next($request);
    }
}