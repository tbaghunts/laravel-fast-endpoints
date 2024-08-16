<?php

namespace Tests\Unit\Commands;

use Baghunts\LaravelFastEndpoint\ServiceProvider;

use Tests\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            ServiceProvider::class,
        ];
    }
}