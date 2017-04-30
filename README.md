# WordPress Kit

[![Packagist Pre Release](https://img.shields.io/packagist/vpre/korobochkin/wp-kit.svg)](https://packagist.org/packages/korobochkin/wp-kit) [![Travis](https://img.shields.io/travis/korobockin/wp-kit.svg)](https://travis-ci.org/korobochkin/wp-kit) [![Packagist](https://img.shields.io/packagist/dt/korobochkin/wp-kit.svg)](https://packagist.org/packages/korobochkin/wp-kit)

If you tired with plain WordPres functions and long unreadable code you need to switch to OOP code. It's easy! This library is created for making WordPress more friendly. Plugin and theme authors can create more reusable components and products by using this library.

## Examples of usage

### Options

Options is the one of component from `DataComponents` series. Options represents the native WordPress options which you can use with `get_option()` or `update_option()` functions from WordPress. But this way of usage is not very handy.

**The Options component in WP Kit is options on steroids.**
 
 1. Each time when you are trying to use option you need manually type its name. Without auto complete. And if your product have many options you can get confused. WP Kit solves this issue.
   
 2. Options in WordPress not handling with variable types. If you are saving `integer` and after saving and retrieve value back you get `string` value which you need manually convert. WP Kit solves this with DataTransformers and you always get data in desired type.
 
 3. Now you have chance to validate your options. No more manual validations for emails, urls, strings... You can easily define the rules of validation (Constraints) and error messages. 
 
 4. And that's only the key features of Option component!

Here is most simple usage of `Option` class. Very helpful if you want to use not your options, for example from other plugins or WordPress options. 

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

The more advanced usage is creating unique classes for each option which you have in your product. After that if you want use your option you can just use this class to retrieve the value.

```php
namespace Korobochkin\MyProject\Options;
use Korobochkin\WPKit\Options\Option;

class TokenOption extends Option {
  public function __construct() {
    $this->setName(Plugin::NAME . '_token');
  }
}

// Anythere in your code

// Create the option instance
$option = new TokenOption();

// Retrieve the value from DB.
$option->get();
```

### Transients

Transients are very similar to Options. All the difference the only in one thing: `expiration` instead of `autoload`.

## How to install?

Use Composer. The publishing on WordPress will be in the near future.

```bash
composer require korobochkin/wp-kit
```
