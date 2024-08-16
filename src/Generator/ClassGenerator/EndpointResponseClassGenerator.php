<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoint\Generator\ClassGenerator;
use Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Traits\WithRequestGenerator;

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