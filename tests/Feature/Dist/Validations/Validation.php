<?php

namespace Tests\Feature\Dist\Validations;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

class Validation extends Endpoint
{
    public function __invoke(Request $request): array
    {
        return [
          "required" => $request->required,
          "sometimes" => $request->sometimes,
        ];
    }
}