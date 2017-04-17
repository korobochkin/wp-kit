<?php
namespace Korobochkin\WPKit\Tests\Transients\Special;

use Korobochkin\WPKit\Transients\Special\BoolTransient;
use Symfony\Component\Form\Exception\TransformationFailedException;

class BoolTransientTest extends \WP_UnitTestCase {

	/**
	 * @var BoolTransient
	 */
	protected $transient;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->transient = new BoolTransient();
		$this->transient->setName('wp_kit_bool_transient');
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
		$this->assertEquals(false, $this->transient->get());
	}

	public function getDataCases() {
		$values = array(
			array(true,        true),
			array(false,       false),

			array(1234,        TransformationFailedException::class),
			array(0,           TransformationFailedException::class),
			array(-1234,       TransformationFailedException::class),
			array(PHP_INT_MAX, TransformationFailedException::class),
			//array(PHP_INT_MIN, true),

			array(1.234,       TransformationFailedException::class),
			array(1.2e3,       TransformationFailedException::class),
			array(7E-10,       TransformationFailedException::class),
			array(-1.234,      TransformationFailedException::class),
			array(-1.2e3,      TransformationFailedException::class),
			array(-7E-10,      TransformationFailedException::class),

			array('1',         TransformationFailedException::class),
			array('VALUE',     TransformationFailedException::class),
			array('true',      TransformationFailedException::class),
			array('false',     TransformationFailedException::class),
			array('',          TransformationFailedException::class),
			array('0',         TransformationFailedException::class),

			array(array(),     TransformationFailedException::class),
			array(array(1),    TransformationFailedException::class),
			array(array(1, 2), TransformationFailedException::class),
			array(array(''),   TransformationFailedException::class),
			array(array('1'),  TransformationFailedException::class),
			array(array('0'),  TransformationFailedException::class),

			array(new \stdClass(), TransformationFailedException::class),
			array(new \WP_Query(), TransformationFailedException::class),

			array(NULL,        NULL)
		);

		// Only for PHP 7
		$result = version_compare(phpversion(), '7');
		if($result == 0 || $result == 1) {
			$values[] = array(PHP_INT_MIN, TransformationFailedException::class);
		}

		return $values;
	}
}
