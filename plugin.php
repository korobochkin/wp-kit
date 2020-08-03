<?php
declare(strict_types=1);

/*
Plugin Name: WP Kit
Plugin URI: https://korobochkin.github.io/wp-kit/
Description: Tools for WordPress developers.
Author: Kolya Korobochkin
Author URI: https://github.com/korobochkin
Version: 1.0.0
Text Domain: wp-kit
Domain Path: /languages/
Requires at least: 4.0
Tested up to: 5.4.2
License: GPLv2 or later
*/

if (!interface_exists('Korobochkin\WPKit\Plugins\PluginInterface')) {
    require_once __DIR__ . '/vendor/autoload.php';
}
