<?php
namespace Korobochkin\WPKit\Options;

abstract class AbstractBoolOption extends AbstractOption {

	/**
	 * @return bool Always returns bool values.
	 */
	public function getValue() {
		if(isset($this->value))
			return $this->value;

		$raw = $this->getValueRaw();

		if($raw !== false) {
			if($raw === '1') {
				return true;
			} else {
				return false;
			}
		}

		return $this->getDefaultValue();
	}

	/**
	 * @inheritdoc
	 */
	public function setValue($value) {
		$this->value = (bool)$value;
		return $this;
	}

	public function setDefaultValue($defaultValue) {
		$this->defaultValue = (bool)$defaultValue;
		return $this;
	}
}
