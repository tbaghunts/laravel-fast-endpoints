<?php

namespace Tests\Feature\Dist\RequestMethods;

use Baghunts\LaravelFastEndpoints\Attributes\Route;
use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

#[Route("/route", EnumEndpointMethod::POST)]
class RouteEndpoint extends Method {}