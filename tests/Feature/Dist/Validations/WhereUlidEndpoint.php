<?php

namespace Tests\Feature\Dist\Validations;

use Baghunts\LaravelFastEndpoints\Attributes\Delete;
use Baghunts\LaravelFastEndpoints\Attributes\WhereUlid;

#[WhereUlid(['required', 'sometimes'])]
#[Delete('/validation/where-ulid/{required}/{sometimes?}')]
class WhereUlidEndpoint extends Validation {}