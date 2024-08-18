<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoints\Attributes\WhereIn;
use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfigContract;

use Tests\Unit\Attributes\Abstract\TestCase;

class WhereInTest extends TestCase
{
    protected function getNamespace(): string
    {
        return WhereIn::class;
    }

    private function makeInstance(
        array|string $parameters,
        array $values
    ): EndpointConfigContract
    {
        return $this->getInstance([
            "parameters" => $parameters,
            "values" => $values,
        ]);
    }

    public function test_singleNameCase()
    {
        $this->assertEquals(
            [
                [
                    "status",
                    [1, 2, 3]
                ]
            ],
            $this->makeInstance("status", [1,2,3])->getWhereIn()
        );
    }

    public function test_multipleNameCase()
    {
        $this->assertEquals(
            [
                [["status", "user_status"], [1, 2]],
            ],
            $this->makeInstance(
                ["status", "user_status"],
                [1, 2]
            )->getWhereIn()
        );
    }

}