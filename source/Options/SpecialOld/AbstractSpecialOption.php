<?php
namespace Korobochkin\WPKit\Options\SpecialOld;

use Korobochkin\WPKit\Options\AbstractOption;

abstract class AbstractSpecialOption extends AbstractOption implements SpecialOptionInterface {

	/**
	 * @inheritdoc
	 */
	public function getSpecial() {
		return $this->prepareSpecial($this->get());
	}

	/**
	 * @inheritdoc
	 */
	public function prepareSpecial($value) {
		return $this->prepareSpecial($value);
	}
}
