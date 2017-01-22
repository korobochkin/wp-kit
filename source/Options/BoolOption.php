<?php
namespace Korobochkin\WPKit\Options;

use Symfony\Component\Validator\Constraints;

class BoolOption extends AbstractOption {

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
	 * @param bool $value Your bool (flag) value.
	 *
	 * @return $this For chain calls.
	 */
	public function setValue($value) {
		$this->value = (bool)$value;
		return $this;
	}

	/**
	 * @param bool $defaultValue Your default bool (flag) value.
	 *
	 * @return $this For chain calls.
	 */
	public function setDefaultValue($defaultValue) {
		$this->defaultValue = (bool)$defaultValue;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function buildConstraint() {
		new Constraints\Type(array(
			'type' => 'bool'
		));
	}

	/**
	 * Sanitize value before saving.
	 *
	 * If bool just return it. If 1, '1', 'true' then returns true, otherwise false.
	 *
	 * @param mixed $instance A value to sanitize.
	 *
	 * @return bool Always returns bool value.
	 */
	public function sanitize($instance) {
		if(is_bool($instance))
			return $instance;

		if($instance == 1 || $instance === 'true')
			return true;
		else
			return false;
	}
}
