<?php

namespace Tests\Feature\Dist\Binding;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\WithTrashed;

use Tests\Feature\Assets\Models\User;

#[WithTrashed]
#[Get('/validation/with-trashed/{user}')]
class WithTrashedEndpoint extends Endpoint
{
    public function __invoke(User $user): array
    {
        return $user->only([
            "id",
            "name",
            "surname",
        ]);
    }
}