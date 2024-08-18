<?php

namespace Tests\Feature\Dist\Basic;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Group;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

#[Group("userPage")]
#[Group("numericRouteParams")]
#[Get('/basic/grouped/{required}/{sometimes?}')]
class GroupedEndpoint extends Endpoint
{
    public function __invoke(Request $request): array
    {
        return [
            "method" => "GET",
            "data" => [
                "required" => $request->required,
                "sometimes" => $request->sometimes,
            ]
        ];
    }
}