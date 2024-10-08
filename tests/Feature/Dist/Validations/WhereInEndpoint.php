<?php

namespace Tests\Feature\Dist\Validations;

use Baghunts\LaravelFastEndpoints\Attributes\Post;
use Baghunts\LaravelFastEndpoints\Attributes\WhereIn;

#[WhereIn('required', ["id", "uuid"])]
#[WhereIn('sometimes', ["created_at", "updated_at"])]
#[Post('/validation/where-in/{required}/{sometimes?}')]
class WhereInEndpoint extends Validation {}