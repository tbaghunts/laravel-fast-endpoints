<?php

namespace Baghunts\LaravelFastEndpoints\Generator\ClassGenerator;

use Baghunts\LaravelFastEndpoints\Generator\ClassGenerator;
use Baghunts\LaravelFastEndpoints\Generator\ClassGenerator\Traits\WithRequestGenerator;
use Baghunts\LaravelFastEndpoints\Contracts\ClassGenerator\EndpointWithRequestGeneratorContract;

class EndpointRequestClassGeneratorContract extends ClassGenerator implements EndpointWithRequestGeneratorContract
{
    use WithRequestGenerator;

    protected function getStubName(): string
    {
        return "request";
    }
}