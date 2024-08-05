<?php

namespace Tests\Unit\Scanner\Dist\WithAttributes;

use Baghunts\LaravelFastEndpoint\Attributes\Name;
use Baghunts\LaravelFastEndpoint\Attributes\Post;

#[Name('with.name')]
#[Post('/with/name')]
class WithNameAndPost
{

}