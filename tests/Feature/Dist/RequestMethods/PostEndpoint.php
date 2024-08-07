<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoint\Attributes\Post;

#[Post('/post')]
class PostEndpoint extends Method {}