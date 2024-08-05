<?php

namespace Tests\Unit\Scanner\Endpoints;

use Baghunts\LaravelFastEndpoint\Attributes\Name;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;

#[Name('with.name')]
class EndpointWithName extends Endpoint
{

}