<?php
namespace Korobochkin\WPKit\Tests\DataSets;

class DifferentTypesSet implements \Iterator {

	protected $variants;

	protected $key = 0;

	/**
	 * DifferentTypesSet constructor.
	 */
	public function __construct() {
		$values = array(
			array(true),
			array(false),

			array(1234),
			array(0),
			array(-1234),
			array(PHP_INT_MAX),
			//array(PHP_INT_MIN, true),

			array(1.234),
			array(1.2e3),
			array(7E-10),
			array(-1.234),
			array(-1.2e3),
			array(-7E-10),

			array('1'),
			array('VALUE'),
			array('true'),
			array('false'),
			array(''),
			array('0'),

			array(array()),
			array(array(1)),
			array(array(1, 2)),
			array(array('')),
			array(array('1')),
			array(array('0')),

			array(new \stdClass()),
			array(new \WP_Query()),

			array(NULL)
		);

		// Only for PHP 7
		if(PHP_VERSION_ID >= 70000) {
			$values[] = array(PHP_INT_MIN);
		}

		$this->variants = $values;
	}


	public function current() {
		return $this->variants[$this->key];
	}

	public function next() {
		$this->key++;
	}

	public function key() {
		return $this->key();
	}

	public function valid() {
		return isset($this->variants[$this->key()]);
	}

	public function rewind() {
		$this->key = 0;
	}

}
