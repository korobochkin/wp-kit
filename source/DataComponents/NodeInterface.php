<?php
namespace Korobochkin\WPKit\DataComponents;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface NodeInterface {

	/**
	 * The main method to retrieve value.
	 *
	 * Should always returns the value of this node.
	 *
	 * @return mixed Value of this node.
	 */
	public function get();

	/**
	 * Alias for $this->setLocalValue().
	 *
	 * @param $value mixed A value for this node.
	 *
	 * @return $this For chain calls.
	 */
	public function set($value);

	/**
	 * Returns node name which can be used in functions like update_option(option_name).
	 *
	 * @return string
	 */
	public function getName();

	/**
	 * Setup node name, required for each node.
	 *
	 * @param $name string Node name.
	 *
	 * @return $this For chain calls.
	 */
	public function setName($name);

	/**
	 * Get a local value.
	 *
	 * @return mixed Local value.
	 */
	public function getLocalValue();

	/**
	 * Save value in this instance but not actually in DB.
	 *
	 * You can setup local value via this method, validate it and push to the DB if needed or just
	 * delete it (set to null). To save value in DB you need call $this->flush().
	 *
	 * @param $value mixed Value which need to be stored in this instance.
	 *
	 * @return $this For chain calls.
	 */
	public function setLocalValue($value);

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
	 * Retrieve value of node from WordPress DB.
	 *
	 * @return string|bool|array String value of node if exists, false if some cases (option not exists in DB) or array if option saved as array.
	 */
	public function getValueFromWordPress();

	/**
	 * Performs pushing local value ($this->value) into the DB (actually save the value from instance
	 * and remove $this->value because other code can use options directly with get|update|delete_option functions).
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
	 * Because constraints is a instances of classes with custom constructors is much better init them on demand (only
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
	 * Returns an array with Violations after validating.
	 *
	 * May returns empty array if validation was successful.
	 *
	 * @return ConstraintViolationInterface[] Array of validation results.
	 */
	public function validate();

	/**
	 * Returns boolean flag which means is your validation successful or not.
	 *
	 * @return bool True means all is ok, False otherwise.
	 */
	public function isValid();

	/**
	 * Performs fully deletion of option.
	 *
	 * Values in DB and value in this object will be deleted. Default value not deleted by this method.
	 *
	 * @return bool Result of deletion.
	 */
	public function delete();

	/**
	 * Performs deletion of value in this instance.
	 *
	 * @return true Always true after resetting local value.
	 */
	public function deleteLocal();

	/**
	 * Performs deletion of option only in DB.
	 *
	 * Delete option only in DB, local value (if presented) will still stored in this object.
	 *
	 * @return bool Result of deletion.
	 */
	public function deleteFromWP();

	/**
	 * Returns the data transformer which transform the data.
	 *
	 * @return DataTransformerInterface
	 */
	public function getDataTransformer();

	/**
	 * Set the data transformer.
	 *
	 * @param DataTransformerInterface $transformer
	 *
	 * @return $this For chain calls.
	 */
	public function setDataTransformer(DataTransformerInterface $transformer);
}
