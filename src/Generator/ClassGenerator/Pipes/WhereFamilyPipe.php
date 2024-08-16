<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator\EndpointClassGeneratorContract;
use Closure;

abstract class WhereFamilyPipe extends MakeEndpointPipe
{
    abstract function getOptionKey(): string;
    abstract function getAttributeName(): string;

    function handle(EndpointClassGeneratorContract $generator, Closure $next): void
    {
        $value = $this->parseOptionValueToStringArgs(
            $generator->getOption($this->getOptionKey())
        );

        if (!empty($value)) {
            $generator->setAttribute(
                $this->getAttributeName(),
                $value
            );
        }

        $next($generator);
    }
}