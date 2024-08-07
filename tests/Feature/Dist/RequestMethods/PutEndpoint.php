<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoint\Attributes\Put;

#[Put('/put')]
class PutEndpoint extends Method {}