<?php

namespace Tests\Feature\Dist\Validations;

use Baghunts\LaravelFastEndpoints\Attributes\Put;
use Baghunts\LaravelFastEndpoints\Attributes\WhereUuid;

#[WhereUuid("required")]
#[WhereUuid("sometimes")]
#[Put('/validation/where-uuid/{required}/{sometimes?}')]
class WhereUuidEndpoint extends Validation {}