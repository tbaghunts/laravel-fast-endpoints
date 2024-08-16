<?php

namespace Tests\Feature\Dist\Binding;

use Baghunts\LaravelFastEndpoint\Attributes\Get;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoint\Attributes\WithTrashed;

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