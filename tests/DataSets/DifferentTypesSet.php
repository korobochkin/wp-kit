<?php
namespace Korobochkin\WPKit\Tests\DataSets;

/**
 * Class DifferentTypesSet
 * @package Korobochkin\WPKit\Tests\DataSets
 */
class DifferentTypesSet extends AbstractDataSet {

	/**
	 * DifferentTypesSet constructor.
	 */
	public function __construct() {
		$variants = array(
			array(NULL), // 0

			array(true), // 1
			array(false), // 2

			array(1234), // 3
			array(0), // 4
			array(-1234), // 5
			array(PHP_INT_MAX), // 6

			array(1.234), // 7
			array(1.2e3), // 8
			array(7E-10), // 9
			array(-1.234), // 10
			array(-1.2e3), // 11
			array(-7E-10), // 12

			array('1'), // 13
			array('VALUE'), // 14
			array('true'), // 15
			array('false'), // 16
			array(''), // 17
			array('0'), // 18

			array(array()), // 19
			array(array(1)), // 20
			array(array(1, 2)), // 21
			array(array('')), // 22
			array(array('1')), // 23
			array(array('0')), // 24

			array(new \stdClass()), // 25
			array(new \WP_Query()), // 26
		);

		// Only for PHP 7
		if(PHP_VERSION_ID >= 70000) {
			$variants[] = array(PHP_INT_MIN); // 27
		}

		$this->variants = $variants;
		$this->position = 0;
	}
}
