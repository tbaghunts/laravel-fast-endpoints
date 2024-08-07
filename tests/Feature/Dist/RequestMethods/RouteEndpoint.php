<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoint\Attributes\Route;
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

#[Route("/route", EnumEndpointMethod::POST)]
class RouteEndpoint extends Method {}