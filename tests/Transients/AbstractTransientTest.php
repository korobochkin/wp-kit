<?php
namespace Korobochkin\WPKit\Tests\Transients;

use Korobochkin\WPKit\Transients\Transient;

/**
 * Class AbstractTransientTest
 * @package Korobochkin\WPKit\Tests\Transients
 *
 * @group data-components
 */
class AbstractTransientTest extends \WP_UnitTestCase {

	/**
	 * @var Transient
	 */
	protected $stub;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForAbstractClass(Transient::class);
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
		$this->stub->setName('wp_kit_abstract_trait');
		$this->assertFalse($this->stub->getValueFromWordPress());
	}

	public function testDeleteFromWP() {
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

		$this->stub->setName('wp_kit_abstract_trait');
		$this->stub->updateValue('hello');

		// Check that successful pushed into DB
		$this->assertEquals('hello', $this->stub->getValueFromWordPress());

		// Check that successful remove from DB
		$this->assertTrue($this->stub->deleteFromWP());
		$this->assertEquals(false, $this->stub->getValueFromWordPress());
	}

	/**
	 * @dataProvider flushCases
	 */
	public function testFlush($value, $expected) {
		$this->stub->setName('wp_kit_abstract_trait');
		$this->assertEquals($expected, $this->stub->set($value)->flush());
	}

	public function flushCases() {
		return array(
			array(true,        true),
			array(false,       true),

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
			->setName('wp_kit_abstract_trait')
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
