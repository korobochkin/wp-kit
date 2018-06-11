<?php
/*
Plugin Name: WP Kit
Plugin URI: https://wordpress.org/plugins/wp-kit
Description: Tools for WordPress developers.
Author: Kolya Korobochkin
Author URI: https://korobochkin.com/
Version: 0.10.0
Text Domain: wp-kit
Domain Path: /languages/
Requires at least: 4.0.0
Tested up to: 4.9.5
License: GPLv2 or later
*/

if (!interface_exists('Korobochkin\WPKit\Plugins\PluginInterface')) {
    require_once __DIR__ . '/vendor/autoload.php';
}
