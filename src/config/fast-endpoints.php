<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Fast endpoints filesystem destination
    |--------------------------------------------------------------------------
    |
    | The fast-endpoints package scans the files for endpoint class detection
    | and generates the routes by specified attributes. Endpoints should be
    | located at a known distance to make this process faster.
    | The package will scan recursively starting from this point.
    |
    */

    "dist" => app_path("Http/Endpoints"),

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes prefix
    |--------------------------------------------------------------------------
    |
    | All routes declared as fast-endpoints will wrapped by this prefix.
    | If you don't want to have a prefix, leave this value empty.
    |
    */

    "prefix" => "fast",

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes domain
    |--------------------------------------------------------------------------
    |
    | TODO: Write comment
    |
    */
    "domain" => null,

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes middleware
    |--------------------------------------------------------------------------
    |
    | TODO: Write comment
    |
    */
    "middleware" => null,

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes groups
    |--------------------------------------------------------------------------
    |
    | TODO: Write comment
    |
    */
    "groups" => null,

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes namespaces
    |--------------------------------------------------------------------------
    |
    | TODO: Write comment
    |
    */
    "namespaces" => null,

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints request handler
    |--------------------------------------------------------------------------
    |
    | TODO: Write comment
    |
    */
    "request" => \Illuminate\Support\Facades\Request::class,

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints response handler
    |--------------------------------------------------------------------------
    |
    | TODO: Write comment
    |
    */
    "response" => \Illuminate\Support\Facades\Response::class,
];