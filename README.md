# WordPress Kit

[![Packagist Pre Release](https://img.shields.io/packagist/vpre/korobochkin/wp-kit.svg)](https://packagist.org/packages/korobochkin/wp-kit)
[![Codecov branch](https://img.shields.io/codecov/c/github/korobochkin/wp-kit/master.svg)](https://codecov.io/gh/korobochkin/wp-kit)
[![Build Status](https://travis-ci.org/korobochkin/wp-kit.svg?branch=master)](https://travis-ci.org/korobochkin/wp-kit)
[![Packagist](https://img.shields.io/packagist/dt/korobochkin/wp-kit.svg)](https://packagist.org/packages/korobochkin/wp-kit)

If you have been coding with plain WordPress functions and long unreadable code, you need to switch to Object Oriented Programming (OOP) code. It's easy! This library makes WordPress more friendly. Plugin and theme authors can create more reusable components and products by using this library.

* [Code coverage report](https://codecov.io/gh/korobochkin/wp-kit)
* [Homepage on Github Pages](https://korobochkin.github.io/wp-kit/) (with metrics from PHP Unit)

## Available components

* Almost Controllers  
  Handles AJAX and HTTP requests in controllers with Dependency Injection (DI) container and services.
* Cron  
  WordPress Cron events as DI services.
* Options, Post Meta, Term Meta, Transients  
  Validate, save and retrieve any data with *Data Transformers*.
* Pages, Notices and Meta Boxes  
  Settings pages with Symfony Forms, Twig and more.
* Plugins and Themes  
  Base classes for plugins and themes to work with DI.
* Scripts & Styles  
  Enqueue and register scripts and styles in single service.
* Translations  
  Load translations for your plugin and themes.
* Uninstall  
  Delete all data after your plugin or theme on uninstall.
* Utils  
  Helpful functions which can save time while developing.

## How to install?

Use Composer to install this library in your projects.

```bash
composer require korobochkin/wp-kit
```
