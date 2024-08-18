<?php

namespace Tests\Feature\Dist\Permissions;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoints\Attributes\Post;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\Throttle;

#[Throttle(
    requests: 2,
    perMinute: 2,
)]
#[Post('/permissions/blocked/{required}/{sometimes?}')]
class ThrottledEndpoint extends Endpoint
{
    public function __invoke(Request $request): array
    {
        return [
            "method" => "POST",
            "data" => [
                "required" => $request->required,
                "sometimes" => $request->sometimes,
            ]
        ];
    }
}