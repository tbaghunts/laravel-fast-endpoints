<?php

namespace Tests\Feature\Dist\Basic;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

#[Name('echo')]
#[Get("/basic/echo")]
class NamedEndpoint extends Endpoint {
    public function __invoke(Request $request): string
    {
        return $request->get("data") ?? "Basic";
    }
}