<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoints\Attributes\Delete;

#[Delete("/delete")]
class DeleteEndpoint extends Method {}