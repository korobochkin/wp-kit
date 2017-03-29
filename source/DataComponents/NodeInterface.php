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

	/*public function getGroup();

	public function setGroup($group);*/

	public function getLocalValue();

	public function setLocalValue($value);

	public function getValueFromWordPress();

	public function getDefaultValue();

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
