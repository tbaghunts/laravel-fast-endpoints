<?php

namespace Baghunts\LaravelFastEndpoints\Contracts;

interface ScannerContract
{
    public function getFiles(): array;
    public function findEndpoints(): array;
}