<?php
namespace Korobochkin\WPKit\Options\Smart;

interface SmartOptionInterface {

	/**
	 * Returns a value from this instance without converting them and without default value.
	 *
	 * @return mixed
	 */
	public function getLocalValueRaw();

	/**
	 * Returns a default value in raw (as string) format.
	 * @return mixed
	 */
	public function getDefaultValueRaw();
}
