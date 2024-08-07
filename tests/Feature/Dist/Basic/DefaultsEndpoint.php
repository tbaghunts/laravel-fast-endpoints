<?php

namespace Tests\Feature\Dist\Basic;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;

use Baghunts\LaravelFastEndpoint\Attributes\Get;
use Baghunts\LaravelFastEndpoint\Attributes\Defaults;

#[Defaults("required", "req")]
#[Defaults("sometimes", 1030)]
#[Get("/basic/defaults/{required?}/{sometimes?}")]
class DefaultsEndpoint extends Endpoint
{
    public function __invoke(Request $request): array
    {
        return [
            "required" => $request->required,
            "sometimes" => $request->sometimes,
        ];
    }
}