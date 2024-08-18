<?php

namespace Tests\Feature\Dist\Validations;

use Baghunts\LaravelFastEndpoints\Attributes\Post;
use Baghunts\LaravelFastEndpoints\Attributes\WhereNumber;

#[WhereNumber(['required', 'sometimes'])]
#[Post('/validation/where-number/{required}/{sometimes?}')]
class WhereNumberEndpoint extends Validation {}