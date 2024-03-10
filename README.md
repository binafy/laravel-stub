## Laravel Stub

<img src="https://banners.beyondco.de/Laravel%20Stub.png?theme=dark&packageManager=composer+require&packageName=binafy%2Flaravel-stub&pattern=yyy&style=style_1&description=Generate+stub+files+very+easy+in+Laravel+framework&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="laravel-stub-banner">

[![PHP Version Require](http://poser.pugx.org/binafy/laravel-stub/require/php)](https://packagist.org/packages/binafy/laravel-stub)
[![Latest Stable Version](http://poser.pugx.org/binafy/laravel-stub/v)](https://packagist.org/packages/binafy/laravel-stub)
[![Total Downloads](http://poser.pugx.org/binafy/laravel-stub/downloads)](https://packagist.org/packages/binafy/laravel-stub)
[![License](http://poser.pugx.org/binafy/laravel-stub/license)](https://packagist.org/packages/binafy/laravel-stub)
[![Passed Tests](https://github.com/binafy/laravel-stub/actions/workflows/tests.yml/badge.svg)](https://github.com/binafy/laravel-stub/actions/workflows/tests.yml)

- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
    - [Create a stub file](#create-a-stub-file)
    - [How to use Laravel Stub](#how-using-laravel-stub)
    - [`from`](#from)
    - [`to`](#to)
    - [`name`](#name)
    - [`ext`](#ext)
    - [`replace`](#replace)
    - [`replaces`](#replaces)
    - [`download`](#download)
    - [`generate`](#generate)
- [Contributors](#contributors)
- [Security](#security)
- [Changelog](#changelog)
- [License](#license)

<a name="introduction"></a>
## Introduction

The Laravel-Stub package enhances the development workflow in Laravel by providing a set of customizable stubs. Stubs are templates used to scaffold code snippets for various components like models, controllers, and migrations. With Laravel-Stub, developers can easily tailor these stubs to match their project's coding standards and conventions. This package aims to streamline the code generation process, fostering consistency and efficiency in Laravel projects. Explore the customization options and boost your development speed with Laravel-Stub.

<a name="requirements"></a>
## Requirements

***
- ```PHP >= 8.0```
- ```Laravel >= 9.0```


| Version/Laravel | L9                 | L10                | L11                |
|-----------------|--------------------|--------------------|--------------------|
| 1.0             | :white_check_mark: | :white_check_mark: | :white_check_mark: |

<a name="installation"></a>
## Installation

You can install the package with Composer:

```bash
composer require binafy/laravel-stub
```

You don't need to publish anything.

<a name="usage"></a>
## Usage

<a name="create-a-stub-file"></a>
### Create a stub file
First of all, create a stub file called `model.stub`:

```bash
touch model.stub
```

Add some code to that, like this:

```php
<?php

namespace {{ NAMESPACE }};

class {{ CLASS }}
{
    
}
```

<a name="how-using-laravel-stub"></a>
### How to use Laravel Stub

You may use Laravel Stub, you need to use the `LaravelStub` facade:

```php
namespace Binafy\LaravelStub\Facades\LaravelStub;

LaravelStub::class;
```

<a name="from"></a>
### `from`

First thing, you need to use the `from` method to give the stub path:

```php
LaravelStub::from(__DIR__ . 'model.stub');
```

<a name="to"></a>
### `to`

So, you need to determine the destination path of the stub file:

```php
LaravelStub::from(__DIR__ . 'model.stub')
    ->to(__DIR__ . '/App');
```

<a name="name"></a>
### `name`

You can determine the stub file but also attention don't write the stub extension:

```php
LaravelStub::from(__DIR__ . 'model.stub')
    ->to(__DIR__ . '/App')
    ->name('new-model');
```

<a name="ext"></a>
### `ext`

You can determine the stub extension:

```php
LaravelStub::from(__DIR__ . 'model.stub')
    ->to(__DIR__ . '/App')
    ->name('new-model')
    ->ext('php');
```

<a name="replace"></a>
### `replace`

The `replace` method takes two parameters, the first one is the key (variable) and the second one is the value. The value will be replaced with the variable:

```php
LaravelStub::from(__DIR__ . 'model.stub')
    ->to(__DIR__ . '/App')
    ->name('new-model')
    ->ext('php')
    ->replace('NAMESPACE', 'App');
```

<a name="replaces"></a>
### `replaces`

The `replaces` method takes an array. If you want to replace multiple variables you can use this method:

```php
LaravelStub::from(__DIR__ . 'model.stub')
    ->to(__DIR__ . '/App')
    ->name('new-model')
    ->ext('php')
    ->replaces([
        'NAMESPACE' => 'App',
        'CLASS' => 'Milwad'
    ]);
```

<a name="download"></a>
### `download`

If you want to download the stub file, you can use the `download` method:

```php
LaravelStub::from(__DIR__ . 'model.stub')
    ->to(__DIR__ . '/App')
    ->name('new-model')
    ->ext('php')
    ->replaces([
        'NAMESPACE' => 'App',
        'CLASS' => 'Milwad'
    ])
    ->download(); // Return download response
```

<a name="generate"></a>
### `generate`

The important method is `generate`. To generate the stub file at the end you need to use the `generate` method to generate stub file:

```php
LaravelStub::from(__DIR__ . 'model.stub')
    ->to(__DIR__ . '/App')
    ->name('new-model')
    ->ext('php')
    ->replaces([
        'NAMESPACE' => 'App',
        'CLASS' => 'Milwad'
    ])
    ->generate();
```

> **_NOTE:_**  Don't use the `download` and `generate` methods in one chain.

The final file will be like this (`new-model.php`):

```php
<?php

namespace App;

class Milwad
{
    
}
```

<a name="contributors"></a>
## Contributors

Thanks to all the people who contributed. [Contributors](https://github.com/binafy/laravel-stub/graphs/contributors).

<a href="https://github.com/binafy/laravel-stub/graphs/contributors"><img src="https://opencollective.com/laravel-stub/contributors.svg?width=890&button=false" /></a>

<a name="security"></a>
## Security

If you discover any security-related issues, please email `binafy23@gmail.com` instead of using the issue tracker.

<a name="chanelog"></a>
## Changelog

The changelog can be found in the `CHANGELOG.md` file of the GitHub repository. It lists the changes, bug fixes, and improvements made to each version of the Laravel User Monitoring package.

<a name="license"></a>
## License

The MIT License (MIT). Please see [License File](https://github.com/binafy/laravel-stub/blob/1.x/LICENSE) for more information.
