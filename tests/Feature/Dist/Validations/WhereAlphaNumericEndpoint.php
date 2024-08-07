<?php

namespace Tests\Feature\Dist\Validations;

use Baghunts\LaravelFastEndpoint\Attributes\Post;
use Baghunts\LaravelFastEndpoint\Attributes\WhereAlpha;
use Baghunts\LaravelFastEndpoint\Attributes\WhereAlphaNumeric;

#[WhereAlpha('required')]
#[WhereAlphaNumeric('sometimes')]
#[Post('/validation/where-alpha-numeric/{required}/{sometimes?}')]
class WhereAlphaNumericEndpoint extends Validation {}