# WordPress Kit

[![Packagist Pre Release](https://img.shields.io/packagist/vpre/korobochkin/wp-kit.svg)](https://packagist.org/packages/korobochkin/wp-kit) [![Build Status](https://travis-ci.org/korobochkin/wp-kit.svg?branch=master)](https://travis-ci.org/korobochkin/wp-kit) [![Packagist](https://img.shields.io/packagist/dt/korobochkin/wp-kit.svg)](https://packagist.org/packages/korobochkin/wp-kit)

If you have been coding with plain WordPress functions and long unreadable code, you need to switch to Object Oriented Programming (OOP) code. It's easy! This library makes WordPress more friendly. Plugin and theme authors can create more reusable components and products by using this library.

## Table of content

  * Data Components (Options, Post Meta, Settings, Term Meta, Transients)
  * Pages (WordPress Admin Pages)
  * Plugins
  * Themes
  * Utils

## Which other tools used?

Symfony components such as Validator, Forms, Dependency Injection, Twig (as part of Forms rendered engine).

## Examples of usage

### Option

Option is a component from the `DataComponents` series. Option represents the native WordPress options associated with the `get_option()` or `update_option()` WordPress functions, which are not very convienent.

**The Option component in WP Kit is options on steroids.**
 
 1. Each time you use the WordPress option, you have to manually type its name (unless you're using auto complete), and if your product has many options, you can get confused. WP Kit solves this issue.
   
 2. Options in WordPress do not handle variable types. For example, if you save an `integer` variable, after saving and retrieving the value back, you receive a `string` value, which you then need to manually convert back to `integer`. WP Kit solves this with DataTransformers so you always receive the data in your desired type.
 
 3. Also, now you can validate your options data. No more manual validations for emails, urls, strings... You can easily define the rules of validation (Constraints) and error messages. 
 
 4. And those are only the key features of the Option component! There are more.

Here is a simple sample usage of the WP Kit `Option` class. It's very helpful to avoid conflicting options, for example from other plugins or WordPress options. 

```php
use Korobochkin\WPKit\Options\Option;

// Create the option instance
$option = new Option();

$option
  // Set the name
  ->setName(Plugin::NAME . '_option_name')
  
  // Set the value 
  ->setValue('the value of option')
  
  // Actually save the value in DB.
  ->flush();
```

A more advanced usage is creating unique classes for each option in your product, after which to use your option you just use this class to retrieve the value.

```php
namespace Korobochkin\MyProject\Options;
use Korobochkin\WPKit\Options\Option;

class TokenOption extends Option {
  public function __construct() {
    $this->setName(Plugin::NAME . '_token');
  }
}

// Anywhere in your code

// Create the option instance
$option = new TokenOption();

// Retrieve the value from DB.
$option->get();
```

### Transients

Transients are very similar to Options. The only difference is using `expiration` instead of `autoload`.

## How to install?

Use Composer. The will be published on the WordPress repository in the near future.

```bash
composer require korobochkin/wp-kit
```
