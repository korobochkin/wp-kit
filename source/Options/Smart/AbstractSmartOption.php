<?php
namespace Korobochkin\WPKit\Options\Smart;

class AbstractSmartOption {

	public function getLocalValueSpecial(){}

	/**
	 * @inheritdoc
	 */
	public function getLocalValueSpecial() {
		return $this->convertFromStringToValue($this->localValue);
	}
}
