<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoints\Attributes\Options;

#[Options('/options')]
class OptionsEndpoint extends Method {}