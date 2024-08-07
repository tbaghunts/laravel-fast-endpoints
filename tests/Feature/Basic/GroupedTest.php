<?php

namespace Baghunts\tests\Feature\Basic;

use Tests\Feature\TestCase;

class GroupedTest extends TestCase
{
    protected function getFastEndpointsConfig(): array
    {
        return [
            "groups" => [
                "userPage" => [
                    "name" => "page.user",
                ],
                "numericRouteParams" => [
                    "whereNumber" => [
                        "required",
                        "sometimes",
                    ]
                ]
            ]
        ];
    }

    public function test_userPageGroupShouldBeApplied()
    {
        $this->assertEquals(url('/test/basic/grouped/req'), route('page.user', ["required" => "req"]));
    }

    public function test_numericRouteParamsGroupShouldBeApplied()
    {
        $this->get("/test/basic/grouped/req/10")
            ->assertStatus(404);
        $this->get("/test/basic/grouped/11/sometimes")
            ->assertStatus(404);

        $this->get("/test/basic/grouped/11/12")
            ->assertStatus(200)
            ->assertJson([
                "method" => "GET",
                "data" => [
                    "required" => 11,
                    "sometimes" => 12,
                ],
            ]);
    }
}