<?php

namespace Tests\Feature\Dist\Permissions;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoint\Attributes\Get;
use Baghunts\LaravelFastEndpoint\Attributes\Name;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoint\Attributes\Middleware;

use Tests\Feature\Assets\SecureMiddleware;

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