<?php

namespace Tests\Feature\Basic;

use Tests\Feature\TestCase;

class NamedRouteTest extends TestCase
{
    public function test_routeShouldReturnValidUrlByName()
    {
        $this->assertEquals(url('/test/basic/echo'), route('echo'));

        $this->get(route('echo') . "?data=ping")
            ->assertStatus(200)
            ->assertContent("ping");
    }
}