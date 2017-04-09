<?php
namespace Korobochkin\WPKit\Tests\DataSets;

class DifferentTypesAfterSavingSet extends AbstractDataSet {

	/**
	 * DifferentTypesAfterSavingSet constructor.
	 */
	public function __construct() {
		$variants = array(
			array(true,        '1'),
			array(false,       false),

			array(1234,        '1234'),
			array(0,           '0'),
			array(-1234,       '-1234'),
			array(PHP_INT_MAX, (string)PHP_INT_MAX),
			//array(PHP_INT_MIN, true),

			array(1.234,       '1.234'),
			array(1.2e3,       '1.2e3'),
			array(7E-10,       '7E-10'),
			array(-1.234,      '-1.234'),
			array(-1.2e3,      '-1.2e3'),
			array(-7E-10,      '-7E-10'),

			array('1',         '1'),
			array('VALUE',     'VALUE'),
			array('true',      'true'),
			array('false',     'false'),
			array('',          ''),
			array('0',         '0'),

			array(array(),     array()),
			array(array(1),    array(1)),
			array(array(1, 2), array(1, 2)),
			array(array(''),   array('')),
			array(array('1'),  array('1')),
			array(array('0'),  array('0')),

			array(new \stdClass(), new \stdClass()),
			array(new \WP_Query(), new \WP_Query()),

			array(NULL,        '')
		);

		// Only for PHP 7
		if(PHP_VERSION_ID >= 70000) {
			$variants[] = array(PHP_INT_MIN, (string)PHP_INT_MIN); // 27
		}

		$this->variants = $variants;
		$this->position = 0;
	}
}
