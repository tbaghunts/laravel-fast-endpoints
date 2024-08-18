<?php

namespace Baghunts\LaravelFastEndpoints\Contracts;

use Illuminate\Routing\Router;

interface RouterGeneratorContract
{
    public function generate();
}