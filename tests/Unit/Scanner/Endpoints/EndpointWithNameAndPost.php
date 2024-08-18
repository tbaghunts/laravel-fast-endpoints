<?php

namespace Tests\Unit\Scanner\Endpoints;

use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Attributes\Post;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

#[Post('/with/name/post')]
#[Name('with.name.and.post')]
class EndpointWithNameAndPost extends Endpoint
{

}