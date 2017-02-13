<?php
namespace Korobochkin\WPKit\Settings;

use Korobochkin\WPKit\Options\OptionInterface;

class Setting implements SettingInterface {

	/**
	 * @var \Korobochkin\WPKit\Options\OptionInterface Option for this setting.
	 */
	protected $option;

	/**
	 * Setting constructor.
	 *
	 * @param OptionInterface $option
	 */
	public function __construct( OptionInterface $option ) {
		$this->option = $this->setOption($option);
	}

	/**
	 * @return \Korobochkin\WPKit\Options\OptionInterface Option for this setting.
	 */
	public function getOption() {
		return $this->getOption();
	}

	public function setOption(OptionInterface $option) {
		$this->option = $option;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function register() {
		$option = $this->getOption();
		if(isset($option)) {
			register_setting(
				$option->getGroup(),
				$option->getName(),
				array($option, '_sanitize')
			);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function unRegister() {
		$option = $this->getOption();
		if(isset($option)) {
			unregister_setting($option->getGroup(), $option->getName());
		}
	}
}
