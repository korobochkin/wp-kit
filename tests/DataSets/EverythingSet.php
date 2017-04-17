<?php
namespace Korobochkin\WPKit\Tests\DataSets;

class EverythingSet extends AbstractDataSet {

	public function __construct() {
		$variants = array(
			//   |$value          |$expectedResultOfSavingOrDeletion  |$expectedValueFromWP      |
			//   |Initial value   |Result of saving in WP             |Value after saving        |set($val) -> get($val)
			//   |Local value     |or result of deletion              |which will return WP      |
			//   |                |                                   |                          |getting local Value
			array(NULL,            true,                               '',                        ),
			array(true,            true,                               '1',                       ), // 0
			array(false,           false,                              false,                     ), // 1

			array(1234,            true,                               '1234'), // 2
			array(0,               true,                               '0'), // 3
			array(-1234,           true,                               '-1234'), // 4
			array(PHP_INT_MAX,     true,                               (string)PHP_INT_MAX), // 5

			array(1.234,           true,                               '1.234'), // 6
			array(1.2e3,           true,                               '1.2e3'), // 7
			array(7E-10,           true,                               '7E-10'), // 8
			array(-1.234,          true,                               '-1.234'), // 9
			array(-1.2e3,          true,                               '-1.2e3'), // 10
			array(-7E-10,          true,                               '-7E-10'), // 11

			array('1',             true,                               '1'), // 12
			array('VALUE',         true,                               'VALUE'), // 13
			array('true',          true,                               'true'), // 14
			array('false',         true,                               'false'), // 15
			array('',              true,                               ''), // 16
			array('0',             true,                               '0'), // 17

			array(array(),         true,                               array()), // 18
			array(array(1),        true,                               array(1)), // 19
			array(array(1, 2),     true,                               array(1, 2)), // 20
			array(array(''),       true,                               array('')), // 21
			array(array('1'),      true,                               array('1')), // 22
			array(array('0'),      true,                               array('0')), // 23

			array(new \stdClass(), true,                               new \stdClass()), // 24
			array(new \WP_Query(), true,                               new \WP_Query()), // 25
		);

		// Only for PHP 7
		if(PHP_VERSION_ID >= 70000) {
			$variants[] = array(PHP_INT_MIN, true, (string)PHP_INT_MIN); // 27
		}

		$this->variants = $variants;
		$this->position = 0;
	}
}
