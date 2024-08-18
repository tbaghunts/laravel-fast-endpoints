<?php

namespace Tests\Feature\Permissions;

use Tests\Feature\TestCase;

class WithoutThrottleTest extends TestCase
{
    protected function getFastEndpointsConfig(): array
    {
        return [
            'middleware' => ['throttle:1,1'],
        ];
    }

    public function test_secondGuestRequestShouldNotBeAcceptedBecauseAllMiddlewaresUnderThrottle()
    {
        $this->post('test/permissions/guest')
            ->assertStatus(200)
            ->assertJson([
                "method" => "POST",
                "data" => [],
            ]);
        $this->post('test/permissions/guest')
            ->assertTooManyRequests();
    }

    public function test_endpointWithWithoutMiddlewareShouldAcceptRequests()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('test/permissions/without-throttle/123/987')
                ->assertStatus(200)
                ->assertJson([
                    'method' => "POST",
                    'data' => [
                        'required' => '123',
                        'sometimes' => '987',
                    ],
                ]);
        }
    }
}