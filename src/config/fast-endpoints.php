<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Fast endpoints routes prefix
    |--------------------------------------------------------------------------
    |
    | All routes declared as fast-endpoints will wrapped by this prefix. If you
    | don't want to have a prefix, leave this value empty.
    |
    */

    "prefix" => "fast",

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

    "dist" => app_path("Http/Fast"),

    /*
    |--------------------------------------------------------------------------
    | Fast endpoints cache key
    |--------------------------------------------------------------------------
    |
    | The fast-endpoints package routes caching key
    |
    */

    "cache_key" => "fast-endpoints-cache",
];