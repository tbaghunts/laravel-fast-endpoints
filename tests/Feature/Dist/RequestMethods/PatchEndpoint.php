<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoint\Attributes\Patch;

#[Patch('/patch')]
class
PatchEndpoint extends Method {}