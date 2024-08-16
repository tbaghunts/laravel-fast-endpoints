<?php

namespace Tests\Feature\Binding;

use Illuminate\Routing\Middleware\SubstituteBindings;

use Tests\Feature\TestCase;
use Tests\Feature\Assets\Models\Post;
use Tests\Feature\Assets\Models\User;

class ScopeBindingsTest extends TestCase
{
    private ?Post $post;
    private array $users = [];

    protected function getFastEndpointsConfig(): array
    {
        return [
            "middleware" => [SubstituteBindings::class],
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->users[] = User::query()->create([
            'name' => 'Author',
            'surname' => 'Author Surname',
        ]);
        $this->users[] = User::query()->create([
            'name' => 'CoolAuthor',
            'surname' => 'Cool Author Surname',
        ]);

        $this->post = $this->users[1]->posts()->create([
            'title' => 'Cool news',
            'body' => 'Today we are meet humanoids from Andromeda',
        ]);
    }

    public function test_routeShouldBeNotFoundedAsForPostBelongsToSecondsUser()
    {
        [$user] = $this->users;

        $this->get($this->gerUrl($user, $this->post))
            ->assertNotFound();
    }

    public function test_postShouldBeFound()
    {
        [, $user] = $this->users;

        $this->get($this->gerUrl($user, $this->post))
            ->assertStatus(200)
            ->assertJson([
                'user' => $user->toArray(),
                'post' => $this->post->toArray(),
            ]);
    }

    public function gerUrl(User $user, Post $post): string
    {
        return sprintf('/test/binding/scope-bindings/%d/%d', $user->id, $post->id);
    }

}