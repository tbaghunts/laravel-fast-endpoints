<?php

namespace Tests\Unit\Scanner\Endpoints;

use Baghunts\LaravelFastEndpoint\Attributes\Name;
use Baghunts\LaravelFastEndpoint\Attributes\Post;
use Baghunts\LaravelFastEndpoint\Endpoint\Endpoint;

#[Post('/with/name/post')]
#[Name('with.name.and.post')]
class EndpointWithNameAndPost extends Endpoint
{

}