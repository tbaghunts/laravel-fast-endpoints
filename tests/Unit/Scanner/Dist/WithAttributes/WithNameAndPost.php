<?php

namespace Tests\Unit\Scanner\Dist\WithAttributes;

use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Attributes\Post;

#[Name('with.name')]
#[Post('/with/name')]
class WithNameAndPost
{

}