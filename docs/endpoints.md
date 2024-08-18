# Endpoints

[Get Started](index.md) | [Installation](installation.md) | [Configuration](configuration.md) | [Endpoints](endpoints.md) | [Attributes](attributes.md) | [Commands](commands.md)

## LFE Philosophy
In the Laravel Fast Endpoints (LFE) philosophy, each endpoint is represented as a class.
This approach enhances the maintainability and elegance of your API development process.
By structuring endpoints as classes,
developers can more easily manage
and understand the functionality of each endpoint
without having to scroll through large controller files to locate and comprehend specific endpoint methods.

## Endpoint Classes
An endpoint in LFE is essentially a **Laravel Single Action Controller**.
This means that the request handling logic is contained within the `__invoke` method of the class.
This single-responsibility design pattern makes each endpoint more focused and easier to maintain.

### Example of an Endpoint Class
Here’s a simple example of an endpoint class:

```php

<?php

namespace App\Http\Endpoints;

use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Attributes\{
    Get,
    Name,
    WhereUuid,
}

use Illuminate\Http\Request;

#[WhereUuid('id')]
#[Name('user.find')]
#[Get('/users/{id}')]
class UserShowEndpoint extends Endpoint
{
    public function __invoke(Request $request, $id)
    {
        // Handle the request and return a response
        $user = User::findOrFail($id);
        return response()->json($user);
    }
}
```

## Requests and Responses
In Laravel Fast Endpoints (LFE),
it's recommended that request and response classes be organized alongside their corresponding endpoint classes.
This structure helps maintain a clear and logical organization of your API resources,
making it easier for developers to locate and manage related components.

### Recommended Directory Structure
For example, if you have a User and Post resources, the directory structure should look like this:
```shell
Http/Endpoints/
    User/
        Create/
            UserCreateRequest.php
            UserCreateResponse.php
            UserCreateEndpoint.php
        Find/
            UserFindRequest.php
            UserFindResponse.php
            UserFindEndpoint.php
    Post/
        Create/
            PostCreateRequest.php
            PostCreateResponse.php
            PostCreateEndpoint.php
        Delete/
            PostDeleteRequest.php
            PostDeleteResponse.php
            PostDeleteEndpoint.php
```
In this structure:
- Request Class: Handles the validation and processing of incoming HTTP requests.
- Response Class: Manages the formatting and returning of HTTP responses.
- Endpoint Class: Contains the core logic for handling the request and producing the response.

## Auto-Detection of Endpoints
For LFE to automatically detect and register your endpoint classes,
they must be located in the directory
specified by the dist option in the LFE configuration file `config/fast-endpoints.php`.
This directory is where LFE will scan for endpoint classes.

## Endpoint Class Signature
Since the directories may contain other class files,
it is crucial that your endpoint classes extend the `Baghunts\LaravelFastEndpoints\Endpoint\Endpoint` abstract class.
This ensures that the endpoint classes have the correct signature required for dynamic route registration.
By extending this abstract class,
the LFE package can accurately detect and register your endpoints based on their configuration and location.

### Summary
- Class-Based Structure: Each endpoint is a class, following the Single Action Controller pattern.
- Location: Endpoints must be placed in the directory specified by the dist option in the configuration file.
- Inheritance: All endpoint classes must extend the Endpoint abstract class provided by LFE.
- Auto-Registration: LFE automatically detects and registers your endpoint classes based on the configured path.
- By following this structure, you can create clean, maintainable, and scalable endpoints within your Laravel application using the Laravel Fast Endpoints package.

[Prev - Configuration](configuration.md) | [Next - Attributes](attributes.md)