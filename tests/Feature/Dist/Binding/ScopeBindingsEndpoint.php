<?php

namespace Tests\Feature\Dist\Binding;

use Baghunts\LaravelFastEndpoint\Attributes\Get;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoint\Attributes\ScopeBindings;

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