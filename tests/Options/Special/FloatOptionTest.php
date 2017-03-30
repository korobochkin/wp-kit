<?php
namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\FloatOption;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FloatOptionTest extends \WP_UnitTestCase {

	/**
	 * @var FloatOption
	 */
	protected $option;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->option = new FloatOption();
	}

	/**
	 * @dataProvider getDataCases
	 */
	public function testAlwaysGetBoolAfterSaving($value, $expected) {
		$this->option
			->set($value);

		if(class_exists($expected)) {
			if(method_exists($this, 'expectException')) {
				$this->expectException($expected);
				$this->option->flush();
			} else {
				try {
					$this->option->flush();
				}
				catch(\Exception $exception) {
					$this->assertTrue(is_a($exception, $expected));
				}
			}
		} else {
			$this->option->flush();
			$this->assertEquals($expected, $this->option->get());
		}
	}

	/**
	 * @dataProvider getDataCases
	 */
	public function testAlwaysGetBoolWithoutSaving($value, $expected) {
		$this->option->set($value);

		if(class_exists($expected)) {
			$this->assertEquals($value, $this->option->get());
		} else {
			$this->assertEquals($expected, $this->option->get());
		}
	}

	public function testDefaultValue() {
		$this->assertEquals(false, $this->option->get());
	}

	public function getDataCases() {
		$values = array(
			array(true,        TransformationFailedException::class),
			array(false,       TransformationFailedException::class),

			array(1234,        1234.0),
			array(0,           0.0),
			array(-1234,       -1234.0),
			array(PHP_INT_MAX, (float) PHP_INT_MAX),
			//array(PHP_INT_MIN, true),

			array(1.234,       1.234),
			array(1.2e3,       1.2e3),
			array(7E-10,       7E-10),
			array(-1.234,      -1.234),
			array(-1.2e3,      -1.2e3),
			array(-7E-10,      -7E-10),

			array('1',         1.0),
			array('VALUE',     TransformationFailedException::class),
			array('true',      TransformationFailedException::class),
			array('false',     TransformationFailedException::class),
			array('',          TransformationFailedException::class),
			array('0',         0.0),

			array(array(),     TransformationFailedException::class),
			array(array(1),    TransformationFailedException::class),
			array(array(1, 2), TransformationFailedException::class),
			array(array(''),   TransformationFailedException::class),
			array(array('1'),  TransformationFailedException::class),
			array(array('0'),  TransformationFailedException::class),

			array(new \stdClass(), TransformationFailedException::class),
			array(new \WP_Query(), TransformationFailedException::class),

			array(NULL,        NULL),

			array(0,  0.0)
		);

		// Only for PHP 7
		$result = version_compare(phpversion(), '7');
		if($result == 0 || $result == 1) {
			$values[] = array(PHP_INT_MIN, (float) PHP_INT_MIN);
		}

		return $values;
	}
}
