# Changelog

## DEV

* Fixed issue with Runners and static variables ([#20](https://github.com/korobochkin/wp-kit/issues/20)).
* Added tests and docs for Meta Boxes ([#17](https://github.com/korobochkin/wp-kit/issues/17)).
* Fixed PHP Unit tests ([#19](https://github.com/korobochkin/wp-kit/issues/19)).
* Added new services: Translations, Scripts and Styles, Uninstall and more ([#18](https://github.com/korobochkin/wp-kit/issues/18)).
* Reordered versions in changelog.

## 0.6.0 - November 29, 2017

* Added support of Aggregate Options, PostMetas, TermMetas, Transients ([#4](https://github.com/korobochkin/wp-kit/issues/4)).
* Added MetaBoxes classes and interfaces (also for Dashboard widgets) ([#16](https://github.com/korobochkin/wp-kit/issues/16)).
* Improved requiring Composer autoloader.

## 0.5.3 - November 18, 2017

Improved AlmostControllers classes. Allow to use it for Ajax and simple HTTP requests. Fixed a bug with parsing request ([#15](https://github.com/korobochkin/wp-kit/issues/15)).

## 0.5.2 - November 1, 2017

Added `getBasename` method in `Plugin` class. 

## 0.5.1 - October 30, 2017

The `Plugin` and `Theme` classes implements `ContainerAwareInterface`.

## 0.5.0 - October 28, 2017

Introducing AlmostControllers components which can be used for webhooks and ajax requests.

## 0.4.2 - October 28, 2017

* Fixed unexpected Exceptions in `isValid` method ([#11](https://github.com/korobochkin/wp-kit/issues/11)).
* Added more PHP docs.
* Improved Data Components tests.

## 0.4.1 - October 16, 2017

* Added support of [DependencyInjection](https://symfony.com/doc/current/components/dependency_injection.html) Component for Themes and Plugins.
* Refactored Pages interfaces and classes.
* Added tests for Pages classes.
* Added Runners which can help if you use DependencyInjection (+ tests).

## 0.4.0 - October 9, 2017

* Added a small utility for checking if terms meta supported.
 
## 0.3.0 - October 6, 2017

* Added TermMeta classes and interface ([#13](https://github.com/korobochkin/wp-kit/issues/13)).
* Added small Compatibility utility for check versions.

## 0.2.2 - October 4, 2017

* Added form factory getter and setter for page classes.

## 0.2.1 - October 2, 2017

* Fixed code style.

## 0.2.0 - October 2, 2017

* Added draft classes for creating pages.
* Added PHP code sniffer configuration and all code formatted with this standards.
