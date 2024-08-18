<?php

namespace Tests\Feature\Dist\Permissions;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoints\Attributes\Post;
use Baghunts\LaravelFastEndpoints\Attributes\Guest;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

#[Guest]
#[Post('/permissions/guest')]
class GuestEndpoint extends Endpoint
{
    public function __invoke(Request $request): array
    {
        return [
            "method" => $request->method(),
            "data" => $request->post(),
        ];
    }
}