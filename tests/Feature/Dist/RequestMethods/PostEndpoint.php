<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoints\Attributes\Post;

#[Post('/post')]
class PostEndpoint extends Method {}