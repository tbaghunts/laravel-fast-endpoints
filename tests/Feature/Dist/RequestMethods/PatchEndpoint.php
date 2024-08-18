<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoints\Attributes\Patch;

#[Patch('/patch')]
class
PatchEndpoint extends Method {}