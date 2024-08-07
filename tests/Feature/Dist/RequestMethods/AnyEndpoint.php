<?php

namespace Tests\Feature\Dist\RequestMethods;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoint\Attributes\Any;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;

#[Any('/any')]
class AnyEndpoint extends Endpoint
{
    public function __invoke(Request $request): array
    {
        return [
            "data" => $request->all(),
            "method" => $request->getMethod(),
        ];
    }
}