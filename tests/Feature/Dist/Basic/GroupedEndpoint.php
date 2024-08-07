<?php

namespace Tests\Feature\Dist\Basic;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoint\Attributes\Get;
use Baghunts\LaravelFastEndpoint\Attributes\Group;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;

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