<?php

namespace Tests\Feature\Permissions;

use Tests\Feature\TestCase;

class ThrottleTest extends TestCase
{
    public function test_oneRequestPerMinuteShouldBeAccepted()
    {
        $this->doSuccessRequest();
    }

    public function test_twoRequestsPerMinuteShouldBeAccepted()
    {
        $this->doSuccessRequest(2);
    }

    public function test_thirdRequestsPerMinuteShouldNotBeAccepted()
    {
        $this->doSuccessRequest(2);
        $this->doFailedRequest();
    }

    public function test_fourthAndFifthRequestAfterTimeoutShouldBeAcceptedAndSeventhShouldBeFailed()
    {
        $this->doSuccessRequest(2);
        $this->doFailedRequest();

        $this->travel(121)->second();

        $this->doSuccessRequest(2);
        $this->doFailedRequest();
    }

    public function doSuccessRequest(int $times = 1): void
    {
        for ($i = 1; $i <= $times; $i++) {
            $this->post('/test/permissions/blocked/111/222')
                ->assertStatus(200)
                ->assertJson([
                    "method" => "POST",
                    "data" => [
                        "required" => "111",
                        "sometimes" => "222",
                    ],
                ]);
        }
    }

    public function doFailedRequest(): void
    {
        $this->post('/test/permissions/blocked/111/222')
            ->assertTooManyRequests();
    }
}