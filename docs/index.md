# Get Started

[Get Started](index.md) | [Installation](installation.md) | [Configuration](configuration.md) | [Endpoints](endpoints.md) | [Attributes](attributes.md) | [Commands](commands.md)

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

That's it! You've just created and accessed an API endpoint using LFE with minimal setup. 

[Prev - Repository](https://github.com/tbaghunts/laravel-fast-endpoints) | [Next - installation](installation.md)
