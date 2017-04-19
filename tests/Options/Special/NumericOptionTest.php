<?php
namespace Korobochkin\WPKit\Tests\Options\Special;

use Korobochkin\WPKit\Options\Special\NumericOption;
use Korobochkin\WPKit\Tests\DataSets\NumericOption\TypesTransformationSet;

class NumericOptionTest extends \WP_UnitTestCase {

	/**
	 * @var NumericOption
	 */
	protected $stub;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = new NumericOption();
		$this->stub->setName('wp_kit_numeric_option');
	}

	/**
	 * @dataProvider casesTypesAfterSaving
	 *
	 * @var $value    mixed Value to insert and test.
	 * @var $expected mixed Value to compare output value with.
	 */
	public function testTypesAfterSaving($value, $expected) {
		$this->stub
			->set($value);

		if(class_exists($expected)) {
			if(PHP_VERSION_ID >= 70000) {
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

	public function casesTypesAfterSaving() {
		return new TypesTransformationSet();
	}

	/**
	 * @dataProvider casesTypesWithoutSaving
	 *
	 * @var $value    mixed Value to insert and test.
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
		return new TypesTransformationSet();
	}

	public function testDefaultValue() {
		$this->assertEquals(0.0, $this->stub->get());
	}
}
