<?php
namespace Korobochkin\WPKit\Options;

use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractOption implements OptionInterface {

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
	 * @var callable Dynamic sanitizer.
	 */
	protected $sanitizer;

	/**
	 * @var mixed Local version of value. You can save it into DB or just delete.
	 */
	protected $localValue;

	/**
	 * @var mixed Default value which can be used if no value exists in DB.
	 */
	protected $defaultValue;

	/**
	 * @var $autoload bool Flag which define how option should be loaded by WordPress.
	 */
	protected $autoload = true;

	public function get() {
		if(isset($this->value))
			return $this->getLocalValue();

		$raw = $this->getValueFromWordPress();

		if($raw !== false)
			return $raw;

		return $this->getDefaultValue();
	}

	public function set($value) {
		$this->setLocalValue($value);
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @inheritdoc
	 */
	public function setName($name) {
		$this->name = (string)$name;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getGroup() {
		return $this->group;
	}

	/**
	 * @inheritdoc
	 */
	public function setGroup($group) {
		$this->group = (string)$group;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getLocalValue() {
		return $this->localValue;
	}

	/**
	 * @inheritdoc
	 */
	public function setLocalValue($value) {
		$this->localValue = $value;
		return $this;
	}

	public function getValueFromWordPress() {
		return get_option($this->getName());
	}

	/**
	 * @inheritdoc
	 */
	public function getDefaultValue() {
		return $this->defaultValue;
	}

	/**
	 * @inheritdoc
	 */
	public function setDefaultValue($defaultValue) {
		$this->defaultValue = $defaultValue;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function isAutoload() {
		return $this->autoload;
	}

	/**
	 * @inheritdoc
	 */
	public function setAutoload($autoload) {
		$this->autoload = (bool) $autoload;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function getConstraint() {
		if(!$this->constraint)
			$this->setConstraint($this->buildConstraint());

		return $this->constraint;
	}

	/**
	 * @inheritdoc
	 */
	public function setConstraint($constraint) {
		$this->constraint = $constraint;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	abstract public function buildConstraint();

	/**
	 * @inheritdoc
	 */
	public function getValidator() {
		return $this->validator;
	}

	/**
	 * @inheritdoc
	 */
	public function setValidator(ValidatorInterface $validator) {
		$this->validator = $validator;
		return $this;
	}

	/**
	 * @inheritdoc
	 */
	public function validate() {
		return $this->getValidator()->validate($this->get(), $this->getConstraint());
	}

	/**
	 * @inheritdoc
	 */
	public function isValid() {
		$errors = $this->validate();

		if(count($errors) === 0)
			return true;

		return false;
	}

	/**
	 * @inheritdoc
	 */
	public function delete() {
		$result = $this->deleteFromWP();

		if($result)
			$this->setLocalValue(null);

		return $result;
	}

	/**
	 * @inheritdoc
	 */
	public function deleteFromWP() {
		return delete_option($this->getName());
	}

	public function deleteLocal() {
		$this->setLocalValue(null);
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function flush() {
		if(isset($this->value)) {
			try {
				$result = update_option($this->getName(), $this->getLocalValue(), $this->isAutoload());
			}
			catch(\Exception $e) {
				return false;
			}

			if($result)
				$this->setLocalValue(null);

			return $result;
		}
		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function updateValue($value, $autoload = null) {
		$this->setLocalValue($value);

		if(!is_null($autoload))
			$this->setAutoload($autoload);

		return $this->flush();
	}

	/**
	 * @inheritdoc
	 */
	public function getSanitizer() {
		return $this->sanitizer;
	}

	/**
	 * @inheritdoc
	 */
	public function setSanitizer(callable $sanitizer) {
		$this->sanitizer = $sanitizer;
	}

	/**
	 * @inheritdoc
	 */
	public function _sanitize($value) {
		$sanitizer = $this->getSanitizer();
		if(is_callable($sanitizer)) {
			return call_user_func($sanitizer, $value);
		}
		return $this->sanitize($value);
	}

	/**
	 * @inheritdoc
	 */
	public function sanitize($value) {
		return $value;
	}
}
