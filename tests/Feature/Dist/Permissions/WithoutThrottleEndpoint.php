<?php

namespace Tests\Feature\Dist\Permissions;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoints\Attributes\Post;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\WithoutThrottle;

#[WithoutThrottle(
    requests: 1,
    perMinute: 1
)]
#[Post('/permissions/without-throttle/{required}/{sometimes?}')]
class WithoutThrottleEndpoint extends Endpoint
{
    public function __invoke(Request $request): array
    {
        return [
            "method" => $request->method(),
            "data" => [
                "required" => $request->required,
                "sometimes" => $request->sometimes,
            ]
        ];
    }
}