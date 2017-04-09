<?php
namespace Korobochkin\WPKit\Tests\Options;

use Korobochkin\WPKit\Options\Option;
use Korobochkin\WPKit\Tests\DataSets\AfterDeletionSet;
use Korobochkin\WPKit\Tests\DataSets\DifferentTypesAfterSavingSet;
use Korobochkin\WPKit\Tests\DataSets\DifferentTypesSet;

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
	 * @dataProvider casesAutoload
	 */
	public function testAutoload($value, $expected) {
		$this->stub->setName('wp_kit_abstract_option');
		$this->assertEquals($expected, $this->stub->setAutoload($value)->isAutoload());
	}

	public function casesAutoload() {
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

	/**
	 * Test deleting value in WordPress.
	 *
	 * @dataProvider casesDeleteFromWP
	 *
	 * @param $value mixed Any variable types.
	 * @param $expectedDeletingResult bool Result of deleting operation.
	 */
	public function testDeleteFromWP($value, $expectedDeletingResult) {
		// Without name throwing an error
		if(method_exists($this, 'expectException')) {
			// PHP 7
			$this->expectException(\LogicException::class);
			$this->stub->deleteFromWP();
		} else {
			// PHP 5
			try {
				$this->stub->deleteFromWP();
			}
			catch(\Exception $exception) {
				$this->assertTrue(is_a($exception, \LogicException::class));
			}
		}

		// Load value into WordPress
		$this->stub
			->setName('wp_kit_abstract_option')
			->updateValue($value);

		// Check that successful remove from DB
		$this->assertEquals($expectedDeletingResult, $this->stub->deleteFromWP());
		$this->assertFalse($this->stub->getValueFromWordPress());
	}

	public function casesDeleteFromWP() {
		return new AfterDeletionSet();
	}














	/**
	 * @dataProvider flushCases
	 */
	public function testFlush($value, $expected) {
		$this->stub->setName('wp_kit_abstract_option');
		$this->assertEquals($expected, $this->stub->set($value)->flush());
	}

	public function flushCases() {
		return array(
			array(true,        true),
			array(false,       false), // false not saved by WordPress :)

			array(1234,        true),
			array(0,           true),
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
			array('',          true),
			array('0',         true),

			array(array(),     true),
			array(array(1),    true),
			array(array(1, 2), true),
			array(array(''),   true),
			array(array('1'),  true),
			array(array('0'),  true),

			array(new \stdClass(), true),
			array(new \WP_Query(), true),

			array(NULL,        true)
		);
	}

	/**
	 * @dataProvider flushValueCases
	 */
	public function testValueAfterSaving($value, $expected) {
		$this->stub
			->setName('wp_kit_abstract_option')
			->set($value)
			->flush();
		$this->assertEquals($expected, $this->stub->get());
	}

	public function flushValueCases() {
		return array(
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
	}
}
