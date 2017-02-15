<?php
namespace Korobochkin\WPKit\Options\Smart;

class AbstractSmartOption {

	/**
	 * @inheritdoc
	 */
	public function getLocalValueSpecial() {
		return $this->convertFromStringToValue($this->localValue);
	}
}
