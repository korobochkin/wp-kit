<?php
namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\BoolOption;

class BoolOptionTest extends \WP_UnitTestCase {

	/**
	 * @var BoolOption
	 */
	protected $option;

	public function setUp() {
		parent::setUp();
		$this->option = new BoolOption();
	}

	/**
	 * @dataProvider getDataCases
	 */
	public function testAlwaysGetBoolAfterSaving($value, $expected) {
		$this->option
			->set($value)
			->flush();

		$this->assertEquals($expected, $this->option->get());
	}

	public function testAlwaysGetBoolWithoutSaving($value, $expected) {
		$this->option->set($value);
		$this->assertEquals($expected, $this->option->get());
	}

	public function testAlwaysGetBoolWithNoValue() {
		$this->assertEquals(false, $this->option->get());
	}

	public function getDataCases() {
		$values = array(
			array(true,        true),
			array(false,       false),

			array(1234,        true),
			array(0,           false),
			array(-1234,       true),
			array(PHP_INT_MAX, true),
			//array(PHP_INT_MIN, true),

			array(1.234,       true),
			array(1.2e3,       true),
			array(7E-10,       true),
			array(-1.234,      true),
			array(-1.2e3,      true),
			array(-7E-10,      true),

			array('1',         true),
			array('VALUE',     true),
			array('true',      true),
			array('false',     true),
			array('',          false),
			array('0',         false),

			array(array(),     false),
			array(array(1),    true),
			array(array(1, 2), true),
			array(array(''),   true),
			array(array('1'),  true),
			array(array('0'),  true),

			array(new \stdClass(), true),
			array(new \WP_Query(), true),

			array(NULL,        false)
		);

		// Only for PHP 7
		$result = version_compare(phpversion(), '7');
		if($result == 0 || $result == 1) {
			$values[] = array(PHP_INT_MIN, true);
		}

		return $values;
	}
}
