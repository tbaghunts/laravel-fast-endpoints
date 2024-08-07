<?php

namespace Tests\Feature\Dist\Basic;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoint\Attributes\Get;
use Baghunts\LaravelFastEndpoint\Attributes\Name;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;

#[Name('echo')]
#[Get("/basic/echo")]
class NamedEndpoint extends Endpoint {
    public function __invoke(Request $request): string
    {
        return $request->get("data");
    }
}