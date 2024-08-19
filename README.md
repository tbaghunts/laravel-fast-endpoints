# Laravel Fast Endpoints

[![Packagist](https://img.shields.io/packagist/v/baghunts/laravel-fast-endpoints.svg)](https://packagist.org/packages/baghunts/laravel-fast-endpoints])
[![Tests](https://github.com/tbaghunts/laravel-fast-endpoints/actions/workflows/tests.yml/badge.svg)](https://github.com/tbaghunts/laravel-fast-endpoints/actions/workflows/tests.yml)
[![Codecov](https://codecov.io/github/tbaghunts/laravel-fast-endpoints/graph/badge.svg?token=HK2LXD21FR)](https://codecov.io/github/tbaghunts/laravel-fast-endpoints)
[![Downloads](https://img.shields.io/packagist/dt/baghunts/laravel-fast-endpoints.svg?style=flat-square)](https://packagist.org/packages/baghunts/laravel-fast-endpoints)
![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)

**LFE (Laravel Fast Endpoints)** is a developer-friendly and efficient alternative to traditional MVC for providing API services to clients. It introduces a new, fast approach using PHP Attributes and a File-Driven architecture. With LFE, there's no need to manually define routes—they are automatically registered, streamlining the development process.

### Installation

You can install the package via composer:
```shell
composer require baghunts/laravel-fast-endpoints
```

### Quick Example
Let's walk through a simple example to demonstrate how easy it is to create an API endpoint with **LFE**.

```php
<?php  
  
namespace App\Http\Endpoints\HelloWorld;  
  
use Baghunts\LaravelFastEndpoints\Attributes\Get;  
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;  
  
#[Get('/hello-world')]  
class HelloWorldEndpoint extends Endpoint  
{  
    /**  
     * Handle the incoming request for the endpoint with path '/hello-world'
     * 
     * @return string  
     */
    public function __invoke(): string  
    {  
        return 'Hello World!';  
    }  
}
```

**LFE** automatically registers the route for this endpoint.

```php
use App\Http\Endpoints\HelloWorld\HelloWorldEndpoint;

Route::get('/hello-world', HelloWorldEndpoint::class)
```

That's it! You've just created and accessed an API endpoint using LFE with minimal setup. For more details and advanced usage, explore the rest of the [documentation](https://tbaghunts.github.io/laravel-fast-endpoints/).

This quick example will give users a hands-on feel for how LFE simplifies the process of creating API endpoints, making the benefits immediately clear.
