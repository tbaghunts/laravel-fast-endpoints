<?php

namespace Baghunts\LaravelFastEndpoint\Contracts;

use Illuminate\Routing\Router;

interface RouterGeneratorContract
{
    public function generate();
}