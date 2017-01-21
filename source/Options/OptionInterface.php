<?php
namespace Korobochkin\WPKit\Options;

use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Interface OptionInterface represent single option with non nested (non array) values like string or numeric.
 *
 * @package Korobochkin\WPKit\Options
 */
interface OptionInterface {

	/**
	 * Returns option name which can be used in functions like update_option(option_name).
	 *
	 * @return string
	 */
	public function getName();

	/**
	 * @param $name string Option name.
	 *
	 * @return $this Returns instance for chain calls.
	 */
	public function setName($name);

	/**
	 * Returns option group which can be used on settings pages.
	 *
	 * @return string Option group name.
	 */
	public function getGroup();

	/**
	 * Setup option group name for settings pages.
	 *
	 * @param $group string Option group name,
	 *
	 * @return $this Returns instance for chain calls.
	 */
	public function setGroup($group);

	/**
	 * Returns a value from WordPress.
	 *
	 * @return mixed false if option not founded (not exists). Or string (if option exists).
	 * Or array if option saved as array.
	 */
	public function getValueRaw();

	/**
	 * Gets a value from WordPress. If it not exists, then returns a default value of this instance.
	 *
	 * @return mixed Value from WordPress or default value.
	 */
	public function getValue();

	/**
	 * Save value in this instance but not actually in DB.
	 *
	 * You can setup local value via this method, validate it and push to the DB if needed or just
	 * delete it (set to null). To save value in DB you need call $this->flush() or $this->updateValue().
	 *
	 * @param $value mixed Value which need to be stored for this option.
	 *
	 * @return $this For chain calls.
	 */
	public function setValue($value);

	/**
	 * Returns a default value for this instance or null if it not setted up.
	 *
	 * @return mixed Default value for this instance.
	 */
	public function getDefaultValue();

	/**
	 * Setup default value for instance. This value should be returned (used) by default if value
	 * not exists in WordPress DB.
	 *
	 * @param $defaultValue mixed Value which need to be stored as default value for this instance.
	 *
	 * @return $this For chain calls.
	 */
	public function setDefaultValue($defaultValue);

	/**
	 * Describes if this option should be autoloaded by WordPress or not.
	 *
	 * @return bool true if it autoloaded, false otherwise.
	 */
	public function isAutoload();

	/**
	 * Setup how this option should be loaded. This setting not effects immediately. You need call $this->updateValue()
	 * or $this->flush() to persist changes.
	 *
	 * @param $autoload bool True for autoload, false for disable autoload.
	 *
	 * @return $this For chain calls.
	 */
	public function setAutoload($autoload);

	/**
	 * Returns set of Constraints (or just one) for Validator.
	 *
	 * @return ConstraintValidatorInterface[]|ConstraintValidatorInterface Constraint which defines how to validate your value.
	 */
	public function getConstraint();

	/**
	 * Setup set of Constraints (or just one) for Validator.
	 *
	 * @param $constraints ConstraintValidatorInterface[]|ConstraintValidatorInterface Set of constraints
	 * with validator rules.
	 *
	 * @return $this For chain calls.
	 */
	public function setConstraint($constraints);

	/**
	 * This function automatically builds the set of constraints for your instance and return it.
	 *
	 * Because constraints its a instances of classes with custom constructors is much better init them on demand (only
	 * if they needed right now). So you can easily describe how to build your constraints here and that's all.
	 *
	 * After init them you should save it. Example: $this->setConstraint($this->buildConstraint()).
	 *
	 * @return ConstraintValidatorInterface|ConstraintValidatorInterface[] Constraints for this instance.
	 */
	public function buildConstraint();

	/**
	 * Validator can validate your value of this instance. This method returns validator.
	 *
	 * @return ValidatorInterface Symfony's validator which work with Constraints.
	 */
	public function getValidator();

	/**
	 * Setup your Symfony Validator.
	 *
	 * @param ValidatorInterface $validator Validator which should validate values.
	 *
	 * @return $this For chain calls.
	 */
	public function setValidator(ValidatorInterface $validator);

	/**
	 * Returns an array with Violations after validating. May returns empty array if validation was successful.
	 *
	 * @return ConstraintViolationInterface[]|array Array of validation results.
	 */
	public function validate();

	/**
	 * Returns boolean flag which means is your validation successful or not.
	 *
	 * @return bool True means all is ok, False otherwise.
	 */
	public function isValid();

	/**
	 * Performs deletion of option in DB.
	 *
	 * @return bool Result of deletion.
	 */
	public function delete();

	/**
	 * Performs pushing local value $this->value into the DB (actually save the value from instance
	 * and remove $this->value because other code can use option via get_ delete_ option functions).
	 *
	 * @return bool Result of pushing (saving) option in DB.
	 */
	public function flush();

	/**
	 * Set value to object and then immediately save it into the DB (call $this->flush()).
	 *
	 * If operation was unsuccessful then return false and don't delete local value.
	 *
	 * @param $value mixed Any type of value which can be passed to $this->setValue().
	 * @param null|bool $autoload This value passed to $this->setAutoload()
	 *
	 * @return bool Result of $this->flush() call.
	 */
	public function updateValue($value, $autoload = null);

	/**
	 * Helpful then WordPress sanitize value before saving it into DB. You can attach this value to WordPress filter.
	 *
	 * @param $instance mixed Value to sanitize.
	 *
	 * @return mixed Sanitized value.
	 */
	public function sanitize($instance);

	/**
	 * Register option like a setting for WordPress admin settings pages.
	 */
	public function register();

	/**
	 * Unregister option from WordPress admin settings pages.
	 */
	public function unRegister();
}
