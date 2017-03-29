<?php
namespace Korobochkin\WPKit\Settings;

use Korobochkin\WPKit\Options\OptionInterface;

interface SettingInterface {

	/**
	 * Returns option instance for this setting.
	 *
	 * @return OptionInterface Option for this setting.
	 */
	public function getOption();

	/**
	 * Set option for this setting.
	 *
	 * @param OptionInterface $option
	 *
	 * @return $this For chain calls.
	 */
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
