<?php
namespace Korobochkin\WPKit\Settings;

use Korobochkin\WPKit\Options\OptionInterface;

interface SettingInterface {

	public function getOption();

	public function setOption(OptionInterface $option);

	/**
	 * Register option like a setting for WordPress admin settings pages.
	 */
	public function register();

	/**
	 * Unregister option from WordPress admin settings pages.
	 */
	public function unRegister();
}
