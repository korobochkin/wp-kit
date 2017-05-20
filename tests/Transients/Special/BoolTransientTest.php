<?php
namespace Korobochkin\WPKit\Tests\Transients\Special;

use Korobochkin\WPKit\Tests\DataSets\Bool\BoolTransformationSet;
use Korobochkin\WPKit\Transients\Special\BoolTransient;

/**
 * Class BoolTransientTest
 * @package Korobochkin\WPKit\Tests\Transients\Special
 *
 * @group data-components
 */
class BoolTransientTest extends \WP_UnitTestCase {

	/**
	 * @var BoolTransient
	 */
	protected $stub;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = new BoolTransient();
		$this->stub->setName('wp_kit_bool_transient');
	}

	/**
	 * @dataProvider casesTypesAfterSaving
	 *
	 * @var $value mixed Value to insert and test.
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
		return new BoolTransformationSet();
	}

	/**
	 * @dataProvider casesTypesWithoutSaving
	 *
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
		return new BoolTransformationSet();
	}

	public function testDefaultValue() {
		$this->assertEquals(true, $this->stub->get());
	}
}
