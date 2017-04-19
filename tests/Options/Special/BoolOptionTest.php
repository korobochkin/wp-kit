<?php
namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\BoolOption;
use Korobochkin\WPKit\Tests\DataSets;
use Symfony\Component\Form\Exception\TransformationFailedException;

class BoolOptionTest extends \WP_UnitTestCase {

	// TODO: fix this test

	/**
	 * @var BoolOption
	 */
	protected $stub;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = new BoolOption();
		$this->stub->setName('wp_kit_bool_option');
	}

	/**
	 * @dataProvider getDataCases
	 * @var $value mixed Value to insert and test.
	 * @var $expected mixed Value to compare output value with.
	 */
	public function testTypesAfterSaving($value, $expected) {
		$this->stub
			->set($value);

		if(class_exists($expected)) {
			if(method_exists($this, 'expectException')) {
				$this->expectException($expected);
				$this->stub->flush();
			} else {
				try {
					$this->stub->flush();
				}
				catch(\Exception $exception) {
					$this->assertTrue(is_a($exception, $expected));
				}
			}
		} else {
			$this->stub->flush();
			$this->assertEquals($expected, $this->stub->get());
		}
	}

	/**
	 * @dataProvider casesTypesWithoutSaving
	 * @var $value mixed Value to insert and test.
	 * @var $expected mixed Value to compare output value with.
	 */
	public function testTypesWithoutSaving($value, $expected) {
		$this->stub->set($value);

		if(class_exists($expected)) {
			$this->assertEquals($value, $this->stub->get());
		} else {
			$this->assertEquals($expected, $this->stub->get());
		}
	}

	public function casesTypesWithoutSaving() {
		return new DataSets\BoolOption\DifferentTypesAndTransformationSet();
	}

	public function testDefaultValue() {
		$this->assertEquals(true, $this->stub->get());
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

			array(NULL,        true)
		);

		// Only for PHP 7
		$result = version_compare(phpversion(), '7');
		if($result == 0 || $result == 1) {
			$values[] = array(PHP_INT_MIN, TransformationFailedException::class);
		}

		return $values;
	}
}
