<?php
namespace Korobochkin\WPKit\Options;

use Korobochkin\WPKit\Sanitizers\IntegerSanitizer;
use Symfony\Component\Validator\Constraints;

class IntegerOption extends AbstractOption {

	/**
	 * @return int Always returns int values.
	 */
	public function getValue() {
		if(isset($this->value))
			return $this->value;

		$raw = $this->getValueRaw();

		if($raw !== false) {
			return (int)$raw;
		}

		return $this->getDefaultValue();
	}

	/**
	 * @param int $value Your value.
	 *
	 * @return $this For chain calls.
	 */
	public function setValue($value) {
		$this->value = (int)$value;
		return $this;
	}

	/**
	 * @param int $defaultValue Your default value.
	 *
	 * @return $this For chain calls.
	 */
	public function setDefaultValue($defaultValue) {
		$this->defaultValue = (int)$defaultValue;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function buildConstraint() {
		new Constraints\Type(array(
			'type' => 'integer'
		));
	}

	/**
	 * Sanitize value before saving.
	 *
	 * Convert all passed values to integer. If passed object then returns 1.
	 *
	 * @param mixed $instance A value to sanitize.
	 *
	 * @return int Always returns int value.
	 */
	public function sanitize($instance) {
		return IntegerSanitizer::sanitize($instance);
	}
}
