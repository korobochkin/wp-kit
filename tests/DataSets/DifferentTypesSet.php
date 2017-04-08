<?php
namespace Korobochkin\WPKit\Tests\DataSets;

class DifferentTypesSet implements \Iterator {

	protected $variants;

	protected $position = 0;

	/**
	 * DifferentTypesSet constructor.
	 */
	public function __construct() {
		$values = array(
			array(true), // 0
			array(false), // 1

			array(1234), // 2
			array(0), // 3
			array(-1234), // 4
			array(PHP_INT_MAX), // 5
			//array(PHP_INT_MIN, true),

			array(1.234), // 6
			array(1.2e3), // 7
			array(7E-10), // 8
			array(-1.234), // 9
			array(-1.2e3), // 10
			array(-7E-10), // 11

			array('1'), // 12
			array('VALUE'), // 13
			array('true'), // 14
			array('false'), // 15
			array(''), // 16
			array('0'), // 17

			array(array()), // 18
			array(array(1)), // 19
			array(array(1, 2)), // 20
			array(array('')), // 21
			array(array('1')), // 22
			array(array('0')), // 23

			array(new \stdClass()), // 24
			array(new \WP_Query()), // 25

			array(NULL), // 26
		);

		// Only for PHP 7
		if(PHP_VERSION_ID >= 70000) {
			$values[] = array(PHP_INT_MIN); // 27
		}

		$this->variants = $values;
		$this->position = 0;
	}

	public function rewind() {
		$this->position = 0;
	}

	public function current() {
		return $this->variants[$this->position];
	}

	public function key() {
		return $this->position;
	}

	public function next() {
		++$this->position;
	}

	public function valid() {
		return isset($this->variants[$this->position]);
	}
}
