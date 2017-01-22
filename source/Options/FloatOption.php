<?php
namespace Korobochkin\WPKit\Options;

use Korobochkin\WPKit\Sanitizers\FloatSanitizer;
use Symfony\Component\Validator\Constraints;

class FloatOption extends AbstractOption {

	/**
	 * @return float Always returns float values.
	 */
	public function getValue() {
		if(isset($this->value))
			return $this->value;

		$raw = $this->getValueRaw();

		if($raw !== false) {
			return (float)$raw;
		}

		return $this->getDefaultValue();
	}

	/**
	 * @param float $value Your value.
	 *
	 * @return $this For chain calls.
	 */
	public function setValue($value) {
		$this->value = (float)$value;
		return $this;
	}

	/**
	 * @param float $defaultValue Your default value.
	 *
	 * @return $this For chain calls.
	 */
	public function setDefaultValue($defaultValue) {
		$this->defaultValue = (float)$defaultValue;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function buildConstraint() {
		new Constraints\Type(array(
			'type' => 'float'
		));
	}

	/**
	 * Sanitize value before saving.
	 *
	 * Convert all passed values to float. If passed object then returns 1.0.
	 *
	 * @param mixed $instance A value to sanitize.
	 *
	 * @return float Always returns int value.
	 */
	public function sanitize($instance) {
		return FloatSanitizer::sanitize($instance);
	}
}
