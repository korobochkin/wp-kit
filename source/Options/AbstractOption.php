<?php
namespace Korobochkin\WPKit\Options;

use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AbstractOption implements OptionInterface {

	/**
	 * @var string Option name which can be used in functions like update_option(option_name).
	 */
	protected $name;

	/**
	 * @var string The option group which can be used on WordPress admin settings pages.
	 */
	protected $group;

	/**
	 * @var ConstraintValidatorInterface[]|ConstraintValidatorInterface set of Constraints (or just one) for Validator.
	 */
	protected $constraint;

	/**
	 * @var ValidatorInterface Validator for validating values.
	 */
	protected $validator;

	/**
	 * @var mixed Local version of value. You can save it into DB or just delete.
	 */
	protected $value;

	/**
	 * @var mixed Default value which can be used if no value exists in DB.
	 */
	protected $defaultValue;

	/**
	 * @var $autoload bool Flag which define how option should be loaded by WordPress.
	 */
	protected $autoload = true;

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = (string)$name;
		return $this;
	}

	public function getGroup() {
		return $this->group;
	}

	public function setGroup($group) {
		$this->group = (string)$group;
		return $this;
	}

	public function getValueRaw() {
		return get_option($this->getName());
	}

	public function getValue() {
		if(isset($this->value))
			return $this->value;

		$raw = $this->getValueRaw();

		if($raw !== false)
			return $raw;

		return $this->getDefaultValue();
	}

	public function setValue($value) {
		$this->value = $value;
		return $this;
	}

	public function getDefaultValue() {
		return $this->defaultValue;
	}

	public function setDefaultValue($defaultValue) {
		$this->defaultValue = $defaultValue;
		return $this;
	}

	public function isAutoload() {
		return $this->autoload;
	}

	public function setAutoload($autoload) {
		$this->autoload = (bool) $autoload;
		return $this;
	}

	public function getConstraint() {
		if(!$this->constraint)
			$this->setConstraint($this->buildConstraint());

		return $this->constraint;
	}

	public function setConstraint($constraint) {
		$this->constraint = $constraint;
		return $this;
	}

	abstract public function buildConstraint();

	public function getValidator() {
		return $this->validator;
	}

	public function setValidator(ValidatorInterface $validator) {
		$this->validator = $validator;
		return $this;
	}

	public function validate() {
		return $this->getValidator()->validate($this->getValue(), $this->getConstraint());
	}

	public function isValid() {
		$errors = $this->validate();

		if(count($errors) === 0)
			return true;

		return false;
	}

	public function delete() {
		$result = delete_option($this->getName());

		if($result)
			$this->setValue(null);

		return $result;
	}

	public function flush() {
		if(isset($this->value)) {
			try {
				$result = update_option($this->getName(), $this->getValue(), $this->isAutoload());
			}
			catch(\Exception $e) {
				return false;
			}

			if($result)
				$this->setValue(null);

			return $result;
		}
		return true;
	}

	public function updateValue($value, $autoload = null) {
		$this->setValue($value);

		if(!is_null($autoload))
			$this->setAutoload($autoload);

		return $this->flush();
	}

	abstract public function sanitize($instance);

	public function register() {
		register_setting(
			$this->getGroup(),
			$this->getName(),
			array($this, 'sanitize')
		);
	}

	public function unRegister() {
		unregister_setting($this->getGroup(), $this->getName());
	}
}
