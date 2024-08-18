<?php

namespace Tests\Unit\Scanner\Endpoints\Subfolder;

use Baghunts\LaravelFastEndpoints\Attributes\Patch;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\WhereIn;

#[WhereIn('id', [1, 2])]
#[Patch('/with/where/in')]
class SubEndpointWithWhereInAndPatch extends Endpoint
{

}