<?php
namespace Korobochkin\WPKit\Tests\Transients\Special;

use Korobochkin\WPKit\Transients\Special\NumericTransient;
use Symfony\Component\Form\Exception\TransformationFailedException;

class NumericTransientTest extends \WP_UnitTestCase {

	// TODO: fix this test

	/**
	 * @var NumericTransient
	 */
	protected $transient;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->transient = new NumericTransient();
		$this->transient->setName('wp_kit_numeric_transient');
	}

	/**
	 * @dataProvider getDataCases
	 * @var $value mixed Value to insert and test.
	 * @var $expected mixed Value to compare output value with.
	 */
	public function testTypesAfterSaving($value, $expected) {
		$this->transient
			->set($value);

		if(class_exists($expected)) {
			if(method_exists($this, 'expectException')) {
				$this->expectException($expected);
				$this->transient->flush();
			} else {
				try {
					$this->transient->flush();
				}
				catch(\Exception $exception) {
					$this->assertTrue(is_a($exception, $expected));
				}
			}
		} else {
			$this->transient->flush();
			$this->assertEquals($expected, $this->transient->get());
		}
	}

	/**
	 * @dataProvider getDataCases
	 * @var $value mixed Value to insert and test.
	 * @var $expected mixed Value to compare output value with.
	 */
	public function testTypesWithoutSaving($value, $expected) {
		$this->transient->set($value);

		if(class_exists($expected)) {
			$this->assertEquals($value, $this->transient->get());
		} else {
			$this->assertEquals($expected, $this->transient->get());
		}
	}

	public function testDefaultValue() {
		$this->assertEquals(0.0, $this->transient->get());
	}

	public function getDataCases() {
		$values = array(
			array(true,        TransformationFailedException::class),
			array(false,       TransformationFailedException::class),

			array(1234,        1234.0),
			array(0,           0.0),
			array(-1234,       -1234.0),
			//array(PHP_INT_MAX, TransformationFailedException::class), // this case throwing error but PHP 7 not catching it
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

			array(NULL,        0.0),
		);

		// Only for PHP 7
		// this case throwing error but PHP 7 not catching it
		/*$result = version_compare(phpversion(), '7');
		if($result == 0 || $result == 1) {
			$values[] = array(PHP_INT_MIN, TransformationFailedException::class);
		}*/

		return $values;
	}
}
