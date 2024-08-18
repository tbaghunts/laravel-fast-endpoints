<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoints\Attributes\Get;

#[Get("/get")]
class GetEndpoint extends Method {}