<?php

namespace Tests\Feature\Dist\Validations;

use Baghunts\LaravelFastEndpoint\Attributes\Put;
use Baghunts\LaravelFastEndpoint\Attributes\WhereUuid;

#[WhereUuid("required")]
#[WhereUuid("sometimes")]
#[Put('/validation/where-uuid/{required}/{sometimes?}')]
class WhereUuidEndpoint extends Validation {}