<?php

namespace Tests\Feature\Dist\Permissions;

use Baghunts\LaravelFastEndpoint\Attributes\Get;
use Baghunts\LaravelFastEndpoint\Attributes\Middleware;
use Baghunts\LaravelFastEndpoint\Attributes\Name;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;
use Tests\Feature\Assets\Middlewares\SecureMiddleware;
use Illuminate\Http\Request;

#[Name("route.with.middleware")]
#[Middleware(SecureMiddleware::class)]
#[Get("/permissions/middleware/{required}/{sometimes?}")]
class MiddlewareEndpoint extends Endpoint
{
    public function __invoke(Request $request): array
    {
        return [
            "method" => $request->getMethod(),
            "data" => [
                "required" => $request->required,
                "sometimes" => $request->sometimes,
            ]
        ];
    }
}