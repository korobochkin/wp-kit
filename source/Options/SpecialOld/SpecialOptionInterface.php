<?php
namespace Korobochkin\WPKit\Options\Special;

interface SpecialOptionInterface {

	/**
	 * Returns a value from this instance without converting them and without default value.
	 *
	 * @return mixed
	 */
	public function getSpecial();

	public function prepareSpecial($value);
}
