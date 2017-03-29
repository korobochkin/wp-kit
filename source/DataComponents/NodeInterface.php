<?php
namespace Korobochkin\WPKit\DataComponents;

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
	 * Retrieve value of node from WordPress DB.
	 *
	 * @return string|bool|array String value of node if exists, false if some cases (option not exists in DB) or array if option saved as array.
	 */
	public function getValueFromWordPress();

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

	public function getConstraint();

	public function setConstraint($constraints);

	public function buildConstraint();

	public function getValidator();

	public function validate();

	public function isValid();

	public function delete();

	public function deleteFromWP();

	public function deleteLocal();

	public function flush();

	public function updateValue($value, $autoload = null);
}
