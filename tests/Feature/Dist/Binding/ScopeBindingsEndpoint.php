<?php

namespace Tests\Feature\Dist\Binding;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\ScopeBindings;

use Tests\Feature\Assets\Models\Post;
use Tests\Feature\Assets\Models\User;

#[ScopeBindings]
#[Get('/binding/scope-bindings/{user}/{post}')]
class ScopeBindingsEndpoint extends Endpoint
{
    public function __invoke(User $user, Post $post): array
    {
        return [
            "user" => $user->toArray(),
            "post" => $post->toArray(),
        ];
    }
}