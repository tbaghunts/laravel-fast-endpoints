<?php

namespace Tests\Unit\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Generator\Pipes\GroupPipe;
use Illuminate\Support\Facades\Config;
use Tests\Unit\Generator\Pipes\Abstract\PipeTestCase;

class GroupPipeTest extends PipeTestCase
{
    protected function getNamespace(): string
    {
        return GroupPipe::class;
    }

    public function test_groupShouldNotBeMergedIfPackageGroupConfigIsNull()
    {
        Config::set('fast-endpoints.groups', null);

        $this->endpointConfigMock
            ->expects($this->never())
            ->method('mergeCollection');

        $this->handle();
    }

    public function test_groupShouldNotBeMergedIfPackageGroupConfigIsEmpty()
    {
        Config::set('fast-endpoints.groups', []);

        $this->endpointConfigMock
            ->expects($this->never())
            ->method('mergeCollection');

        $this->handle();
    }

    public function test_groupShouldNotBeMergedIfConfigIsEmpty()
    {
        Config::set('fast-endpoints.groups', [
            "group1" => [
                "middleware" => ["middleware-1"],
            ],
            "group2" => [
                "whereUuid" => ["uuid"],
                "domain" => "{account}.fast.com",
            ],
        ]);

        $this->endpointConfigMock
            ->method('getGroups')
            ->willReturn([]);

        $this->endpointConfigMock
            ->expects($this->never())
            ->method('mergeCollection');

        $this->handle();
    }

    public function test_groupShouldBeMergedIfConfigNotEmpty()
    {
        Config::set('fast-endpoints.groups', [
            "group1" => [
                "middleware" => ["middleware-1"],
            ],
            "group2" => [
                "whereUuid" => ["uuid"],
                "domain" => "{account}.fast.com",
            ],
        ]);

        $this->endpointConfigMock
            ->method('getGroups')
            ->willReturn([
                "group1"
            ]);

        $this->endpointConfigMock
            ->expects($this->once())
            ->method('mergeCollection')
            ->with([
                ["middleware" => ["middleware-1"],]
            ]);

        $this->handle();
    }

    public function test_groupShouldBeMergedWithMultipleGroupsIfConfigNotEmpty()
    {
        Config::set('fast-endpoints.groups', [
            "group1" => [
                "name" => "group.1",
                "middleware" => ["middleware-1"],
            ],
            "group2" => [
                "whereUuid" => ["uuid"],
                "domain" => "{account}.fast.com",
            ],
            "group3" => [
                "middleware" => ["middleware-2"],
                "whereIn" => [
                    ["status", [0, 1]]
                ],
                "name" => "group.3",
            ],
        ]);

        $this->endpointConfigMock
            ->method('getGroups')
            ->willReturn([
                "group1",
                "group3",
            ]);

        $this->endpointConfigMock
            ->expects($this->once())
            ->method('mergeCollection')
            ->with([
                [
                    "name" => "group.1",
                    "middleware" => ["middleware-1"],
                ],
                [
                    "middleware" => ["middleware-2"],
                    "whereIn" => [
                        ["status", [0, 1]]
                    ],
                    "name" => "group.3",
                ],
            ]);

        $this->handle();
    }
}