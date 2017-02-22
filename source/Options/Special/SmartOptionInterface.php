<?php
namespace Korobochkin\WPKit\Options\Special;

interface SmartOptionInterface {

	/**
	 * Returns a value from this instance without converting them and without default value.
	 *
	 * @return mixed
	 */
	public function getSpecial();

	public function getLocalValueSpecial();

	public function getValueFromWordPressSpecial();

	/**
	 * Returns a default value in raw (as string) format.
	 * @return mixed
	 */
	public function getDefaultValueRaw();
}
