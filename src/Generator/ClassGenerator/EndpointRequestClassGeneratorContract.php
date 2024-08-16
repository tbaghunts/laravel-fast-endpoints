<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator;

use Baghunts\LaravelFastEndpoint\Generator\ClassGenerator;
use Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Traits\WithRequestGenerator;
use Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator\EndpointWithRequestGeneratorContract;

class EndpointRequestClassGeneratorContract extends ClassGenerator implements EndpointWithRequestGeneratorContract
{
    use WithRequestGenerator;

    protected function getStubName(): string
    {
        return "request";
    }
}