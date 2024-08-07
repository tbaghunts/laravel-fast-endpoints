<?php

namespace Tests\Feature\Dist\Binding;

use Baghunts\LaravelFastEndpoint\Attributes\Get;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;

use Tests\Feature\Models\User;

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