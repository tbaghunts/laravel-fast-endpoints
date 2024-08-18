<?php

namespace Tests\Feature\Dist\Validations;

use Baghunts\LaravelFastEndpoints\Attributes\Post;
use Baghunts\LaravelFastEndpoints\Attributes\WhereAlpha;
use Baghunts\LaravelFastEndpoints\Attributes\WhereAlphaNumeric;

#[WhereAlpha('required')]
#[WhereAlphaNumeric('sometimes')]
#[Post('/validation/where-alpha-numeric/{required}/{sometimes?}')]
class WhereAlphaNumericEndpoint extends Validation {}