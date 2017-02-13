<?php
namespace Korobochkin\WPKit\Settings;

use Korobochkin\WPKit\Options\OptionInterface;

interface SettingInterface {

	public function getOption();

	public function setOption(OptionInterface $option);

	public function register();

	public function unRegister();
}
