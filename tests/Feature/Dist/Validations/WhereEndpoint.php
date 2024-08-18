<?php

namespace Tests\Feature\Dist\Validations;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Where;

#[Where('required', '[0-9]+')]
#[Where(['sometimes' => '[A-Za-z-]+'])]
#[Get('/validation/where/{required}/{sometimes?}')]
class WhereEndpoint extends Validation {}