<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Where;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

use Tests\Unit\Attributes\Abstract\TestCase;

class WhereTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Where::class;
    }

    private function makeInstance(string|array $name, ?string $expression = null): EndpointConfigContract
    {
        return $this->getInstance([
            "name" => $name,
            "expression" => $expression,
        ]);
    }

    public function test_singleWhereShouldBeAddedToList()
    {
        $this->assertEquals(
            [
                "whereName" => "whereExpression",
            ],
            $this->makeInstance("whereName", "whereExpression")->getWhere()
        );
    }

    public function test_multipleWhereShouldBeAddedToList()
    {
        $this->assertEquals(
            [
                "where1" => "where1Expression",
                "where2" => "where2Expression",
                "where3" => "where3Expression",
            ],
            $this->makeInstance([
                "where1" => "where1Expression",
                "where2" => "where2Expression",
                "where3" => "where3Expression",
            ])->getWhere()
        );
    }
}