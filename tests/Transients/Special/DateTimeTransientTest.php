<?php
namespace Korobochkin\WPKit\Tests\Transients\Special;

use Korobochkin\WPKit\Tests\DataSets\DateTime\DateTimeTransformationSet;
use Korobochkin\WPKit\Transients\Special\DateTimeTransient;

class DateTimeTransientTest extends \WP_UnitTestCase {

	/**
	 * @var DateTimeTransient
	 */
	protected $stub;

	/**
	 * Prepare option for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = new DateTimeTransient();
		$this->stub->setName('wp_kit_datetime_transient');
	}

	/**
	 * @dataProvider casesTypes
	 *
	 * @var $value mixed Value to insert and test.
	 * @var $expected mixed Value to compare output value with.
	 */
	public function testTypes($value, $expected) {
		$this->stub->set($value);

		if(is_a($expected, \DateTime::class)) {
			$this->stub->flush();
			$this->assertEquals($expected, $this->stub->get());
		} else {
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
		}
	}

	public function casesTypes() {
		return new DateTimeTransformationSet();
	}

	public function testNull() {
		$this->stub->set(null);
		$this->assertEquals('', $this->stub->get());
	}
}
