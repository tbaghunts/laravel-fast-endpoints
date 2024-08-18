<?php

namespace Baghunts\LaravelFastEndpoints\Generator\ClassGenerator;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoints\Generator\ClassGenerator;
use Baghunts\LaravelFastEndpoints\Generator\ClassGenerator\Traits\WithRequestGenerator;

class EndpointResponseClassGenerator extends ClassGenerator
{
    use WithRequestGenerator;

    protected function getStubName(): string
    {
        return 'response';
    }

    protected function getReplaceable(): array
    {
        return [
            'REQUEST' => $this->getRequestParamDeclaration(),
        ];
    }

    private function getRequestParamDeclaration(): string
    {
        $classname = $this->getRequestNamespace();
        if (!$classname) {
            $this->setImport(Request::class);
            $classname = 'Request';
        }

        return sprintf(
            '%s %s',
            $classname,
            '$request'
        );
    }
}