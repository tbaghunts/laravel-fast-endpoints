<?php

namespace Tests\Unit\Scanner\Endpoints\Subfolder;

use Baghunts\LaravelFastEndpoint\Attributes\Patch;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoint\Attributes\WhereIn;

#[WhereIn('id', [1, 2])]
#[Patch('/with/where/in')]
class SubEndpointWithWhereInAndPatch extends Endpoint
{

}