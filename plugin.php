<?php
/*
Plugin Name: WP Kit
Plugin URI: https://korobochkin.github.io/wp-kit/
Description: Tools for WordPress developers.
Author: Kolya Korobochkin
Author URI: https://korobochkin.com/
Version: 0.11.0
Text Domain: wp-kit
Domain Path: /languages/
Requires at least: 4.0
Tested up to: 5.0.2
License: GPLv2 or later
*/

if (!interface_exists('Korobochkin\WPKit\Plugins\PluginInterface')) {
    require_once __DIR__ . '/vendor/autoload.php';
}
