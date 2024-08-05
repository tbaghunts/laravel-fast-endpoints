<?php

namespace Baghunts\LaravelFastEndpoint\Contracts;

interface ScannerContract
{
    public function getFiles(): array;
    public function findEndpoints(): array;
}