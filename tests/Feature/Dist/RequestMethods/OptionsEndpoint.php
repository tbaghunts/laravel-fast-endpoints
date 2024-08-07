<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoint\Attributes\Options;

#[Options('/options')]
class OptionsEndpoint extends Method {}