# Attributes

[Get Started](index.md) | [Installation](installation.md) | [Configuration](configuration.md) | [Endpoints](endpoints.md) | [Attributes](attributes.md) | [Commands](commands.md)

In Laravel Fast Endpoints (LFE),
attributes play a pivotal role in configuring and managing the behavior of your endpoints.
These attributes provide a declarative way to define how endpoints should handle requests,
including the HTTP methods they respond to, the paths they register,
and any additional configurations that may be necessary.

## What Are Attributes?
Attributes in LFE are special classes that allow developers to configure endpoints directly within the endpoint class itself,
using PHP’s attribute syntax.
This approach eliminates the need for repetitive or boilerplate code,
enabling a more concise and readable way to manage endpoint configurations.

## Benefits of Using Attributes
- **Declarative Configuration**: Attributes provide a clear and concise way to define the behavior of an endpoint, making your code more readable and maintainable.
- **Simplified Route Management**: With attributes, you can easily specify the HTTP method, path, and other settings without manually configuring routes or middleware.
- **Enhanced Flexibility**: Attributes allow for fine-grained control over each endpoint, enabling you to tailor the behavior of individual endpoints based on specific needs.
- **Automatic Route Registration**: By using attributes, routes are automatically registered based on the configuration defined within the endpoint class, streamlining the development process.

## How Attributes Work
When you apply an attribute to an endpoint class,
LFE automatically processes that attribute to configure the endpoint according to the settings you’ve specified.
For example, if you use the Any attribute,
LFE will ensure that the endpoint is registered to handle requests for all HTTP methods.

Here’s a basic example of how to use attributes in an endpoint class:

```php

Copy code
<?php

namespace App\Http\Endpoints\User;

use Illuminate\Http\Request;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;

#[Get('/users')]
class UserGetEndpoint extends Endpoint
{
    public function __invoke(Request $request)
    {
        // Handle the GET request and return a response
        return response()->json(['message' => 'Handled GET request']);
    }
}
```

### Extending Attributes
LFE also allows you to create custom attributes by extending the base attribute classes provided by the package.
This enables you to implement specialized behavior tailored to your application’s needs.

## Attributes

| **Attribute**         | **Description**                                                                                             | **Usage Example**                     | **Purpose**                                                             | **Repeatable** |
|-----------------------|-------------------------------------------------------------------------------------------------------------|---------------------------------------|--------------------------------------------------------------------------|----------------|
| `Any`                 | Handles requests for all HTTP methods (`GET`, `POST`, `PUT`, `DELETE`, etc.).                               | `#[Any('/path')]`                     | Configures an endpoint to handle any HTTP method at the specified path.  | Non-repeatable |
| `Can`                 | Defines authorization logic using policies.                                                                 | `#[Can('view', Post::class)]`         | Ensures the user has permission to perform the action.                   | Repeatable     |
| `Defaults`            | Sets default values for route parameters.                                                                   | `#[Defaults(['id' => 1])]`            | Provides default values for route parameters if not supplied.            | Rrepeatable    |
| `Delete`              | Configures an endpoint to handle `DELETE` requests.                                                         | `#[Delete('/path')]`                  | Handles `DELETE` requests at the specified path.                         | Non-repeatable |
| `Get`                 | Configures an endpoint to handle `GET` requests.                                                            | `#[Get('/path')]`                     | Handles `GET` requests at the specified path.                            | Non-repeatable |
| `Group`               | Groups multiple endpoints under a common configuration.                                                     | `#[Group('admin')]`                   | Applies a shared configuration to grouped endpoints.                    | Repeatable     |
| `Guest`               | Ensures the endpoint is accessible to unauthenticated users.                                                | `#[Guest]`                            | Allows access to guests (unauthenticated users).                         | Non-repeatable |
| `Middleware`          | Specifies middleware to apply to the endpoint.                                                              | `#[Middleware('auth')]`               | Attaches middleware like authentication to the endpoint.                 | Repeatable     |
| `Name`                | Assigns a name to the route, useful for route generation.                                                   | `#[Name('route.name')]`               | Defines a name for easy route referencing.                               | Non-repeatable |
| `Options`             | Configures an endpoint to handle `OPTIONS` requests.                                                        | `#[Options('/path')]`                 | Handles `OPTIONS` requests at the specified path.                        | Non-repeatable |
| `Patch`               | Configures an endpoint to handle `PATCH` requests.                                                          | `#[Patch('/path')]`                   | Handles `PATCH` requests at the specified path.                          | Non-repeatable |
| `Post`                | Configures an endpoint to handle `POST` requests.                                                           | `#[Post('/path')]`                    | Handles `POST` requests at the specified path.                           | Non-repeatable |
| `Put`                 | Configures an endpoint to handle `PUT` requests.                                                            | `#[Put('/path')]`                     | Handles `PUT` requests at the specified path.                            | Non-repeatable |
| `Route`               | Manually defines the full route for an endpoint and specifies allowed HTTP methods using `EnumEndpointMethod`. | `#[Route('custom/path', EnumEndpointMethod::GET, EnumEndpointMethod::POST)]` | Provides a custom route and specifies which HTTP methods to allow.       | Non-repeatable      |
| `ScopeBindings`       | Applies scope bindings to the route, useful for scoped resource routes.                                     | `#[ScopeBindings]`                    | Ensures scoped binding is applied to the route.                          | Non-repeatable |
| `Throttle`            | Sets rate-limiting on the endpoint by specifying the number of requests allowed per minute.                  | `#[Throttle(60, 1)]`                                  | Configures rate-limiting, e.g., 60 requests per minute.                  | Repeatable          |
| `Where`               | Applies custom regular expressions to a route parameter.                                                    | `#[Where('id', '[0-9]+')]`            | Restricts a parameter to match a specific pattern.                       | Repeatable     |
| `WhereAlpha`          | Restricts a route parameter to alphabetic characters only.                                                  | `#[WhereAlpha('parameter')]`          | Ensures the parameter only contains alphabetic characters.               | Repeatable     |
| `WhereAlphanumeric`   | Restricts a route parameter to alphanumeric characters only.                                                | `#[WhereAlphanumeric('parameter')]`   | Ensures the parameter only contains alphanumeric characters.             | Repeatable     |
| `WhereIn`             | Restricts a route parameter to a specific set of values.                                                    | `#[WhereIn('parameter', ['a', 'b'])]` | Limits the parameter to specific values.                                  | Repeatable     |
| `WhereNumber`         | Restricts a route parameter to numeric values only.                                                         | `#[WhereNumber('parameter')]`         | Ensures the parameter only contains numbers.                             | Repeatable     |
| `WhereUlid`           | Restricts a route parameter to a valid ULID format.                                                         | `#[WhereUlid('parameter')]`           | Ensures the parameter is a valid ULID.                                   | Repeatable     |
| `WhereUuid`           | Restricts a route parameter to a valid UUID format.                                                         | `#[WhereUuid('parameter')]`           | Ensures the parameter is a valid UUID.                                   | Repeatable     |
| `WithoutMiddleware`   | Removes middleware from the endpoint.                                                                       | `#[WithoutMiddleware('auth')]`        | Excludes specific middleware from being applied.                         | Repeatable     |
| `WithoutThrottle`     | Disables or customizes throttling for the endpoint, with options for requests and per minute settings.        | `#[WithoutThrottle(100, 2)]`                           | Disables or customizes rate-limiting settings for the endpoint.          | Repeatable          |
| `WithTrashed`         | Includes soft-deleted (trashed) records in the endpoint's response.                                         | `#[WithTrashed]`                      | Allows access to soft-deleted resources.                                 | Non-repeatable |

[Prev - Endpoints](endpoints.md) | [Next - Commands](commands.md)