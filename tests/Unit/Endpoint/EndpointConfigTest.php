<?php

namespace Tests\Unit\Endpoint;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

class EndpointConfigTest extends TestCase
{
    public function getInstance(): EndpointConfigContract
    {
        return new EndpointConfig(
            name: "default.name",
            whereNumber: ["id"],
        );
    }

    public function test_oneGroupMergeCase()
    {
        $instance = $this->getInstance();

        $instance->merge([
            "name" => "group.1",
            "middleware" => ["middleware-1"],
        ]);

        $this->assertEquals([
            "name" => "group.1",
            "whereNumber" => ["id"],
            "middleware" => ["middleware-1"],
        ], [
            "name" => $instance->getName(),
            "whereNumber" => $instance->getWhereNumber(),
            "middleware" => $instance->getMiddleware(),
        ]);
    }

    public function test_multipleGroupMergeCase()
    {
        $instance = $this->getInstance();

        $instance->merge([
            "name" => "group.1",
            "withTrashed" => true,
            "middleware" => ["middleware-1"],
        ]);
        $instance->merge([
            "middleware" => ["middleware-2"],
            "whereIn" => [
                ["status", [0, 1]]
            ],
            "name" => "group.3",
        ]);
        $instance->merge([
            "withTrashed" => false,
        ]);

        $this->assertEquals([
            "name" => "group.3",
            "whereNumber" => ["id"],
            "withTrashed" => false,
            "middleware" => ["middleware-1", "middleware-2"],
        ], [
            "name" => $instance->getName(),
            "whereNumber" => $instance->getWhereNumber(),
            "withTrashed" => $instance->getWithTrashed(),
            "middleware" => $instance->getMiddleware(),
        ]);
    }

    public function test_multipleGroupsCollectionMergeCase()
    {
        $instance = $this->getInstance();

        $instance->mergeCollection([
            [
                "name" => "group.1",
                "withTrashed" => true,
                "middleware" => ["middleware-1"],
            ],
            [
                "whereNumber" => ["age", "status"],
                "notExistsProp" => "this prop should be ignored",
            ],
            [
                "middleware" => ["middleware-2"],
                "whereIn" => [
                    ["status", [0, 1]]
                ],
                "name" => "group.3",
            ],
            [
                "withTrashed" => false,
            ]
        ]);

        $this->assertEquals([
            "name" => "group.3",
            "whereNumber" => ["id", "age", "status"],
            "withTrashed" => false,
            "middleware" => ["middleware-1", "middleware-2"],
        ], [
            "name" => $instance->getName(),
            "whereNumber" => $instance->getWhereNumber(),
            "withTrashed" => $instance->getWithTrashed(),
            "middleware" => $instance->getMiddleware(),
        ]);
    }

}