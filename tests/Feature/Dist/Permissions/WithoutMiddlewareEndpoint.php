<?php

namespace Tests\Feature\Dist\Permissions;

use Baghunts\LaravelFastEndpoint\Attributes\Post;
use Baghunts\LaravelFastEndpoint\Attributes\WithoutMiddleware;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;
use Tests\Feature\Assets\Middlewares\SecureMiddleware;
use Illuminate\Http\Request;

#[WithoutMiddleware(SecureMiddleware::class)]
#[Post('/permissions/without-middleware/{required}/{sometimes?}')]
class WithoutMiddlewareEndpoint extends Endpoint
{
    public function __invoke(Request $request): array
    {
        return [
            "method" => $request->method(),
            "data" => [
                "required" => $request->required,
                "sometimes" => $request->sometimes,
            ],
        ];
    }
}