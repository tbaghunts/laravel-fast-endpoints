<?php

namespace Baghunts\LaravelFastEndpoints\Enums;

enum EnumEndpointMethod: string
{
    case ANY = "ANY";
    case GET = "GET";
    case PUT = "PUT";
    case POST = "POST";
    case HEAD = "HEAD";
    case PATCH = "PATCH";
    case DELETE = "DELETE";
    case OPTIONS = "OPTIONS";
}