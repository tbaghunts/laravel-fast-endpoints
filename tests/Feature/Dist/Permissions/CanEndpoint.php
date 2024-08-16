<?php

namespace Tests\Feature\Dist\Permissions;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoint\Attributes\Can;
use Baghunts\LaravelFastEndpoint\Attributes\Put;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;

#[Can('update-permission')]
#[Put('/permissions/can/{required}/{sometimes?}')]
class CanEndpoint extends Endpoint
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