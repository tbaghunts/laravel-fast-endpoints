<?php

namespace Tests\Feature\Dist\Permissions;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoint\Attributes\Post;
use Baghunts\LaravelFastEndpoint\Attributes\Guest;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;

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