<?php

namespace Tests\Feature\Dist\Validations;

use Baghunts\LaravelFastEndpoint\Attributes\Delete;
use Baghunts\LaravelFastEndpoint\Attributes\WhereUlid;

#[WhereUlid(['required', 'sometimes'])]
#[Delete('/validation/where-ulid/{required}/{sometimes?}')]
class WhereUlidEndpoint extends Validation {}