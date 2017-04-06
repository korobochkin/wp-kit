<?php
namespace Korobochkin\WPKit\Tests\Options;

use Korobochkin\WPKit\Options\Option;

class AbstractOptionTest extends \WP_UnitTestCase {

	/**
	 * @var Option
	 */
	protected $stub;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForAbstractClass(Option::class);
	}

	/**
	 * Test without setting name.
	 */
	public function testGetValueFromWordPress() {
		if(method_exists($this, 'expectException')) {
			// PHP 7
			$this->expectException(\LogicException::class);
			$this->stub->getValueFromWordPress();
		} else {
			// PHP 5
			try {
				$this->stub->getValueFromWordPress();
			}
			catch(\Exception $exception) {
				$this->assertTrue(is_a($exception, \LogicException::class));
			}
		}
	}

	/**
	 * Test with setting name before request value.
	 */
	public function testGetValueFromWordPressWithName() {
		$this->stub->setName('wp_kit_abstract_option');
		$this->assertFalse($this->stub->getValueFromWordPress());
	}

	/**
	 * @dataProvider autoloadCases
	 */
	public function testSetAutoload($value, $expected) {
		$this->stub->setName('wp_kit_abstract_option');
		$this->assertEquals($expected, $this->stub->setAutoload($value)->isAutoload());
	}

	public function autoloadCases() {
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
