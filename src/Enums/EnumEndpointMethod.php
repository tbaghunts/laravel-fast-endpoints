<?php

namespace Baghunts\LaravelFastEndpoint\Enums;

enum EnumEndpointMethod: string
{
    case ANY = "any";
    case GET = "get";
    case PUT = "put";
    case POST = "post";
    case HEAD = "head";
    case PATCH = "patch";
    case DELETE = "delete";
    case OPTIONS = "options";
}