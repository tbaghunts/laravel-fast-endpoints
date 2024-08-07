<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoint\Attributes\Get;

#[Get("/get")]
class GetEndpoint extends Method {}