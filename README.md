## Laravel Stub

<img src="https://banners.beyondco.de/Laravel%20Stub.png?theme=dark&packageManager=composer+require&packageName=binafy%2Flaravel-stub&pattern=yyy&style=style_1&description=Generate+stub+files+very+easy+in+Laravel+framework&md=1&showWatermark=0&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" alt="laravel-stub-banner">

[![PHP Version Require](http://poser.pugx.org/binafy/laravel-stub/require/php)](https://packagist.org/packages/binafy/laravel-stub)
[![Latest Stable Version](http://poser.pugx.org/binafy/laravel-stub/v)](https://packagist.org/packages/binafy/laravel-stub)
[![Total Downloads](http://poser.pugx.org/binafy/laravel-stub/downloads)](https://packagist.org/packages/binafy/laravel-stub)
[![License](http://poser.pugx.org/binafy/laravel-stub/license)](https://packagist.org/packages/binafy/laravel-stub)
[![Passed Tests](https://github.com/binafy/laravel-stub/actions/workflows/tests.yml/badge.svg)](https://github.com/binafy/laravel-stub/actions/workflows/tests.yml)

## Introduction

The Laravel-Stub package enhances the development workflow in Laravel by providing a set of customizable stubs. Stubs are templates used to scaffold code snippets for various components like models, controllers, and migrations. With Laravel-Stub, developers can easily tailor these stubs to match their project's coding standards and conventions. This package aims to streamline the code generation process, fostering consistency and efficiency in Laravel projects. Explore the customization options and boost your development speed with Laravel-Stub.

## Installation

You can install the package with Composer:

```bash
composer require binafy/laravel-stub
```

You don't need to publish anything.

## Usage

First of all, create a stub file call `model.stub`:

```bash
touch model.stub
```

Add some code to that, like this:

```php
<?php

namespace {{ NAMESPACE }}

class {{ CLASS }}
{
    
}
```

