<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoints\Attributes\Put;

#[Put('/put')]
class PutEndpoint extends Method {}