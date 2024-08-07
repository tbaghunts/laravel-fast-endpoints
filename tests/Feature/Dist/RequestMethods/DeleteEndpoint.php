<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoint\Attributes\Delete;

#[Delete("/delete")]
class DeleteEndpoint extends Method {}