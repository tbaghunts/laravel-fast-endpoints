<?php

namespace Baghunts\LaravelFastEndpoint\Contracts;

use Illuminate\Support\Collection;

interface ScannerContract
{
    public function findEndpoints(): Collection;
}