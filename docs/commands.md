# Commands

[Get Started](index.md) | [Installation](installation.md) | [Configuration](configuration.md) | [Endpoints](endpoints.md) | [Attributes](attributes.md) | [Commands](commands.md)

Laravel Fast Endpoints (LFE) provides a single command to simplify the generation of endpoint classes,
request classes, and response classes.
The command is designed
to streamline API development by automatically generating necessary files with the required configurations.

## Make Endpoint Command
The make:fast-endpoint command is used
to generate a Fast Endpoint class along with optional request and response handlers.
This command supports various configurations, including HTTP methods, authorization, middleware, and validation rules.

```shell
php artisan make:fast-endpoint /users/{id} --get --with-request --with-response
```

### Description
The make:fast-endpoint command generates a Fast Endpoint class with optional request and response handlers.
It allows customization of the endpoint through various options,
including HTTP methods, authorization, middleware, and validation rules.

### Options and Arguments
| Option/Argument         | Description                                                                                                         |
|-------------------------|---------------------------------------------------------------------------------------------------------------------|
| `path`                  | The URI path for the endpoint. This is a required argument.                                                          |
| `--with-request`        | Generates an endpoint request class. If provided, the request class will extend the configuration defined in `fast-endpoints.php`. |
| `--with-response`       | Generates an endpoint response class. If provided, the response class will extend the configuration defined in `fast-endpoints.php`. |
| `--name`                | The name of the endpoint.                                                                                           |
| `--dist`                | Specifies the destination path for the endpoint class.                                                              |
| `--request`             | Specifies the request handler class for the endpoint.                                                               |
| `--response`            | Specifies the response handler class for the endpoint.                                                              |
| `--defaults`            | Specifies default values for dynamic segments in the endpoint URI.                                                   |
| `--any`                 | Allows any HTTP method for the endpoint.                                                                            |
| `--get`                 | Allows GET method for the endpoint.                                                                                  |
| `--put`                 | Allows PUT method for the endpoint.                                                                                  |
| `--post`                | Allows POST method for the endpoint.                                                                                 |
| `--head`                | Allows HEAD method for the endpoint.                                                                                |
| `--patch`               | Allows PATCH method for the endpoint.                                                                               |
| `--delete`              | Allows DELETE method for the endpoint.                                                                              |
| `--options`             | Allows OPTIONS method for the endpoint.                                                                            |
| `--can`                 | Specifies authorization can(s) for the endpoint.                                                                    |
| `--guest`               | Allows guest access to the endpoint.                                                                               |
| `--throttle`            | Specifies throttling rules for the endpoint (e.g., `60, 1` for 60 requests per minute).                             |
| `--middleware`          | Specifies middleware(s) for the endpoint.                                                                           |
| `--without-throttle`    | Excludes specific throttling rules for the endpoint.                                                                 |
| `--without-middleware`  | Excludes specific middleware(s) for the endpoint.                                                                   |
| `--with-trashed`        | Includes trashed records in the endpoint.                                                                           |
| `--scope-bindings`      | Enables scope bindings for the endpoint.                                                                            |
| `--where-uuid`          | Defines UUID validation rule for URI segment parameters.                                                             |
| `--where-ulid`          | Defines ULID validation rule for URI segment parameters.                                                             |
| `--where-number`        | Defines numerical validation rule for URI segment parameters.                                                         |
| `--where-alpha`         | Defines alphabetical validation rule for URI segment parameters.                                                     |
| `--where-alpha-numeric` | Defines alphanumeric validation rule for URI segment parameters.                                                      |

#### Command Behavior
- Request Generation: If the --with-request option is specified, a request class will be generated, extending the configuration defined in fast-endpoints.php.
- Response Generation: If the --with-response option is specified, a response class will be generated, extending the configuration defined in fast-endpoints.php.
- Endpoint Generation: The endpoint class will be generated based on the provided URI path and options.
- File Handling: The command will handle file generation and overwrite existing files if confirmed by the user.
- The MakeEndpointCommand simplifies endpoint creation by generating necessary classes with specified configurations and options, enhancing the development workflow.

[Prev - Attributes](attributes.md) | [Next - Repository](https://github.com/tbaghunts/laravel-fast-endpoints)