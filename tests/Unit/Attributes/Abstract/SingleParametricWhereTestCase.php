<?php

namespace Tests\Unit\Attributes\Abstract;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

abstract class SingleParametricWhereTestCase extends TestCase
{
    protected abstract function getMethodName(): string;
    protected abstract function getSingleValue(): string;
    protected abstract function getMultipleValues(): array;

    protected function makeInstance(array|string $parameters): EndpointConfigContract
    {
        return $this->getInstance([
            "parameters" => $parameters
        ]);
    }

    public function test_singleValueCase()
    {
        $methodName = $this->getMethodName();
        $singleValue = $this->getSingleValue();

        $this->assertEquals(
            [$singleValue],
            $this->makeInstance($singleValue)->{$methodName}()
        );
    }

    public function test_multipleValueCase()
    {
        $methodName = $this->getMethodName();
        $multipleValues = $this->getMultipleValues();

        $this->assertEquals(
            $multipleValues,
            $this->makeInstance($multipleValues)->{$methodName}()
        );
    }
}