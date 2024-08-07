<?php

namespace Tests\Feature\Dist\Validations;

use Baghunts\LaravelFastEndpoint\Attributes\Post;
use Baghunts\LaravelFastEndpoint\Attributes\WhereNumber;

#[WhereNumber(['required', 'sometimes'])]
#[Post('/validation/where-number/{required}/{sometimes?}')]
class WhereNumberEndpoint extends Validation {}