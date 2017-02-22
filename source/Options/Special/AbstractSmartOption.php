<?php
namespace Korobochkin\WPKit\Options\Special;

class AbstractSpecialOption {

	/**
	 * @inheritdoc
	 */
	public function getLocalValueSpecial() {
		return $this->convertFromStringToValue($this->localValue);
	}
}
