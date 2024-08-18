---
layout: default
title: Installation
---

### Requirements

Before installing the **Laravel Fast Endpoints (LFE)** package, make sure your environment meets the following minimum requirements:

- **PHP:** 8.3 or higher
- **Laravel:** 11 or higher

### Install the Package

You can install the package via Composer. Run the following command in your terminal:

```shell
composer require baghunts/laravel-fast-endpoints
```

This will download and install the package, making it available for use in your Laravel project.

### Publish Vendor Resources

The LFE package comes with publishable resources, including configuration files and stubs. To publish these resources, use the following Artisan command:

```shell
php artisan vendor:publish --provider="Baghunts\LaravelFastEndpoints\ServiceProvider"
```

Publishing vendor resources allows you to customize the package's behavior to better suit your application’s needs. The following resources are available for publishing:

1. **Configuration File (`config/fast-endpoints.php`)**
   This file contains various settings that control how the LFE package operates, such as the directory for endpoint classes, route prefixes, middleware, and more. Publishing this file allows you to adjust these settings to fit your specific requirements.

2. **Stubs**
   Stubs are template files that the package uses when generating new endpoint classes or other related files. By publishing and modifying these stubs, you can tailor the generated code to follow your project’s conventions and standards.
