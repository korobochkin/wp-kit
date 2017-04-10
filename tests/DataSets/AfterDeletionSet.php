<?php
namespace Korobochkin\WPKit\Tests\DataSets;

class AfterDeletionSet extends AbstractDataSet {

	public function __construct() {
		$variants = array(
			array(true,            true), // 0
			array(false,           false), // 1

			array(1234,            true), // 2
			array(0,               true), // 3
			array(-1234,           true), // 4
			array(PHP_INT_MAX,     true), // 5
			//array(PHP_INT_MIN,   true),

			array(1.234,           true, ), // 6
			array(1.2e3,           true), // 7
			array(7E-10,           true), // 8
			array(-1.234,          true), // 9
			array(-1.2e3,          true), // 10
			array(-7E-10,          true), // 11

			array('1',             true), // 12
			array('VALUE',         true), // 13
			array('true',          true), // 14
			array('false',         true), // 15
			array('',              true), // 16
			array('0',             true), // 17

			array(array(),         true), // 18
			array(array(1),        true), // 19
			array(array(1, 2),     true), // 20
			array(array(''),       true), // 21
			array(array('1'),      true), // 22
			array(array('0'),      true), // 23

			array(new \stdClass(), true), // 24
			array(new \WP_Query(), true), // 25

			array(NULL,            true), // 26
		);

		// Only for PHP 7
		if(PHP_VERSION_ID >= 70000) {
			$variants[] = array(PHP_INT_MIN, true); // 27
		}

		$this->variants = $variants;
		$this->position = 0;
	}
}
