<?php

namespace Tests\Feature\Dist\RequestMethods;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

class Method extends Endpoint
{
    final public function __invoke(Request $request): array
    {
        return [
            "data" => $request->all(),
            "method" => $request->getMethod(),
        ];
    }
}